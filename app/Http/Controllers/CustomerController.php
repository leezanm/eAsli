<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        $totalCustomers = Customer::count();
        $topCustomersCount = Customer::has('sales', '>=', 5)->count();
        $topCustomers = Customer::withSum('sales', 'total_price')
            ->withCount('sales')
            ->having('sales_count', '>=', 1)
            ->orderByDesc('sales_sum_total_price')
            ->limit(5)
            ->get();

        $averageSpend = Customer::withSum('sales', 'total_price')
            ->havingRaw('sales_sum_total_price > 0')
            ->avg('sales_sum_total_price') ?? 0;

        $customers = Customer::all();
        $averageOrders = Customer::withCount('sales')
            ->havingRaw('sales_count > 0')
            ->avg('sales_count') ?? 0;

        return view('customers.index', compact(
            'totalCustomers', 'topCustomersCount', 'topCustomers',
            'averageSpend', 'averageOrders', 'customers'
        ));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'password' => 'required|string|min:6',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        Customer::create($validated);
        return redirect()->route('customers.index')->with('success', 'Customer registered successfully');
    }

    public function show(Customer $customer)
    {
        $sales = $customer->sales()->with(['product', 'artisan'])->get();
        $totalSpent = $customer->getTotalSpent();
        $totalOrders = $customer->getTotalOrders();

        return view('customers.show', compact('customer', 'sales', 'totalSpent', 'totalOrders'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'password' => 'nullable|string|min:6',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $customer->update($validated);
        return redirect()->route('customers.show', $customer)->with('success', 'Customer updated successfully');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully');
    }

    public function topCustomers()
    {
        $customers = Customer::withCount('sales')
            ->withSum('sales', 'total_price')
            ->orderByDesc('sales_sum_total_price')
            ->limit(10)
            ->get();

        return view('customers.top', compact('customers'));
    }

    public function login()
    {
        return view('customers.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $customer = Customer::where('email', $credentials['email'])->first();

        if ($customer && $customer->password && Hash::check($credentials['password'], $customer->password)) {
            Auth::guard('customer')->login($customer);
            return redirect()->route('home')->with('success', 'Login successful. Welcome back!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials are incorrect.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'You have been logged out.');
    }

    public function history(Customer $customer)
    {
        // Only allow customers to view their own history
        if (Auth::guard('customer')->check() && Auth::guard('customer')->id() !== $customer->id) {
            abort(403);
        }

        $sales = $customer->sales()
            ->with(['product', 'artisan'])
            ->latest('sale_date')
            ->paginate(15);

        $totalSpent = $customer->getTotalSpent();
        $totalOrders = $customer->getTotalOrders();

        return view('customers.history', compact('customer', 'sales', 'totalSpent', 'totalOrders'));
    }
}
