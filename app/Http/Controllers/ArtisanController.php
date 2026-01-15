<?php

namespace App\Http\Controllers;

use App\Mail\ArtisanApproved;
use App\Mail\ArtisanRejected;
use App\Models\Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ArtisanController extends Controller
{
    public function index()
    {
        $artisans = Artisan::all();
        return view('artisans.index', compact('artisans'));
    }

    public function create()
    {
        return view('artisans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:artisans',
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
            'password' => 'required|string|min:6',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        // New artisan accounts start as inactive and require admin approval
        $validated['status'] = 'inactive';

        Artisan::create($validated);

        return redirect()->route('artisans.login')->with('success', 'Registration successful. Please wait for admin approval before logging in.');
    }

    public function show(Artisan $artisan)
    {
        return view('artisans.show', compact('artisan'));
    }

    public function edit(Artisan $artisan)
    {
        // Artisans can only edit their own profile; admins can edit any artisan
        if (Auth::guard('artisan')->check() && Auth::guard('artisan')->id() !== $artisan->id) {
            abort(403);
        }

        return view('artisans.edit', compact('artisan'));
    }

    public function update(Request $request, Artisan $artisan)
    {
        // If an admin (web guard) updates, allow status changes
        if (Auth::guard('web')->check()) {
            $oldStatus = $artisan->status;

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:artisans,email,' . $artisan->id,
                'phone' => 'required|string|max:15',
                'address' => 'nullable|string',
                'description' => 'nullable|string',
                'status' => 'required|in:active,inactive',
            ]);

            $artisan->update($validated);

            // If status changed, notify artisan by email
            if ($oldStatus !== $artisan->status) {
                if ($artisan->status === 'active') {
                    Mail::to($artisan->email)->send(new ArtisanApproved($artisan));
                } elseif ($artisan->status === 'inactive') {
                    Mail::to($artisan->email)->send(new ArtisanRejected($artisan));
                }
            }

            return redirect()->route('artisans.show', $artisan)->with('success', 'Profile updated.');
        }

        // If an artisan updates their own profile, they cannot change status
        if (Auth::guard('artisan')->check() && Auth::guard('artisan')->id() === $artisan->id) {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:artisans,email,' . $artisan->id,
                'phone' => 'required|string|max:15',
                'address' => 'nullable|string',
                'description' => 'nullable|string',
            ]);

            $artisan->update($validated);

            return redirect()->route('artisans.dashboard')->with('success', 'Your profile has been updated.');
        }

        // Anyone else is not authorized to update
        abort(403);
    }

    public function destroy(Artisan $artisan)
    {
        $artisan->delete();
        return redirect()->route('artisans.index')->with('success', 'Artisan deleted.');
    }

    public function login()
    {
        return view('artisans.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $artisan = Artisan::where('email', $credentials['email'])->first();

        if ($artisan && Hash::check($credentials['password'], $artisan->password)) {
            if ($artisan->status !== 'active') {
                return back()->withErrors([
                    'email' => 'Your account is not approved yet. Please wait for admin approval.',
                ])->onlyInput('email');
            }

            Auth::guard('artisan')->login($artisan);
            return redirect()->route('artisans.dashboard')->with('success', 'Login successful');
        }

        return back()->withErrors(['email' => 'The provided credentials are incorrect.'])->onlyInput('email');
    }

    public function dashboard()
    {
        if (!Auth::guard('artisan')->check()) {
            return redirect()->route('artisans.login');
        }

        $artisan = Auth::guard('artisan')->user();
        $shopCount = $artisan->shops()->count();
        $productCount = $artisan->products()->count();
        $saleCount = $artisan->sales()->count();
        $totalRevenue = $artisan->sales()->sum('total_price') ?? 0;

        return view('artisans.dashboard', compact('shopCount', 'productCount', 'saleCount', 'totalRevenue'));
    }

    public function logout(Request $request)
    {
        Auth::guard('artisan')->logout();
        $request->session()->invalidate();
        return redirect()->route('home')->with('success', 'You have been logged out.');    }
}
