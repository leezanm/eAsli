<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        if (Auth::guard('artisan')->check()) {
            $shops = Auth::guard('artisan')->user()->shops()->get();
        } else {
            $shops = Shop::with('artisan')->get();
        }
        return view('shops.index', compact('shops'));
    }

    public function create()
    {
        if (Auth::guard('artisan')->check()) {
            $artisan = Auth::guard('artisan')->user();
            return view('shops.form', compact('artisan'));
        }
        return redirect()->route('artisans.login');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'state' => 'nullable|string|max:100',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'phone' => 'nullable|string|max:15',
            'description' => 'nullable|string',
        ]);

        // Auto-populate artisan_id from authenticated user
        if (Auth::guard('artisan')->check()) {
            $validated['artisan_id'] = Auth::guard('artisan')->user()->id;
        } else {
            return redirect()->route('artisans.login')->with('error', 'You must be logged in as an artisan to create a shop.');
        }

        Shop::create($validated);
        return redirect()->route('shops.index')->with('success', 'Shop created successfully');
    }

    public function show(Shop $shop)
    {
        $products = $shop->artisan->products()->get();
        return view('shops.show', compact('shop', 'products'));
    }

    public function edit(Shop $shop)
    {
        $artisans = Artisan::where('status', 'active')->get();
        return view('shops.edit', compact('shop', 'artisans'));
    }

    public function update(Request $request, Shop $shop)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'state' => 'nullable|string|max:100',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'phone' => 'nullable|string|max:15',
            'description' => 'nullable|string',
            'status' => 'required|in:active,closed',
        ]);

        $shop->update($validated);
        return redirect()->route('shops.show', $shop)->with('success', 'Shop updated successfully');
    }

    public function destroy(Shop $shop)
    {
        $shop->delete();
        return redirect()->route('shops.index')->with('success', 'Shop deleted successfully');
    }

    public function map()
    {
        $shops = Shop::where('status', 'active')->get();
        return view('shops.map', compact('shops'));
    }

    public function nearbyShops(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $radius = $request->input('radius', 10); // default 10 km

        $shops = Shop::where('status', 'active')
            ->selectRaw("*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance", [$latitude, $longitude, $latitude])
            ->having('distance', '<', $radius)
            ->orderBy('distance')
            ->get();

        return view('shops.nearby', compact('shops'));
    }
}
