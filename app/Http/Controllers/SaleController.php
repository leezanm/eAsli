<?php

namespace App\Http\Controllers;

use App\Models\Artisan;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $query = Sale::with(['artisan', 'product', 'customer']);

        $filters = [
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'shop_id' => $request->input('shop_id'),
            'artisan_id' => $request->input('artisan_id'),
            'category' => $request->input('category'),
        ];

        // Restrict to current artisan when logged in as artisan
        $currentArtisan = null;
        if (Auth::guard('artisan')->check()) {
            $currentArtisan = Auth::guard('artisan')->user();
            $query->where('artisan_id', $currentArtisan->id);
        } else {
            // Admin can filter by artisan
            if (!empty($filters['artisan_id'])) {
                $query->where('artisan_id', $filters['artisan_id']);
            }

            // Filter by shop: sales whose artisan owns the selected shop
            if (!empty($filters['shop_id'])) {
                $shopId = $filters['shop_id'];
                $query->whereHas('artisan.shops', function ($q) use ($shopId) {
                    $q->where('id', $shopId);
                });
            }
        }

        // Filter by product category
        if (!empty($filters['category'])) {
            $category = $filters['category'];
            $query->whereHas('product', function ($q) use ($category) {
                $q->where('category', $category);
            });
        }

        // Filter by date range (using sale_date)
        if (!empty($filters['start_date'])) {
            $query->whereDate('sale_date', '>=', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $query->whereDate('sale_date', '<=', $filters['end_date']);
        }

        // Clone query before pagination for statistics
        $statsQuery = clone $query;

        $sales = $query->orderByDesc('sale_date')->paginate(20)->withQueryString();
        $totalSales = $statsQuery->count();
        $totalRevenue = (clone $statsQuery)->sum('total_price');
        $averageTransaction = $totalSales > 0 ? $totalRevenue / $totalSales : 0;
        $salesToday = (clone $statsQuery)->whereDate('sale_date', today())->count();

        // Options for filters
        if ($currentArtisan) {
            $shops = $currentArtisan->shops()->orderBy('name')->get();
            $artisans = collect();
        } else {
            $shops = Shop::orderBy('name')->get();
            $artisans = Artisan::orderBy('name')->get();
        }

        $categories = Product::select('category')
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('sales.index', compact(
            'sales',
            'totalSales',
            'totalRevenue',
            'averageTransaction',
            'salesToday',
            'filters',
            'shops',
            'artisans',
            'categories'
        ));
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::where('stock', '>', 0)->get();

        return view('sales.form', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'artisan_id' => 'required|exists:artisans,id',
            'product_id' => 'required|exists:products,id',
            'customer_id' => 'required|exists:customers,id',
            'quantity' => 'required|integer|min:1',
            'sale_date' => 'required|date',
            'payment_status' => 'required|in:pending,paid,failed',
            'notes' => 'nullable|string',
        ]);

        $product = Product::find($validated['product_id']);

        if ($product->stock < $validated['quantity']) {
            return back()->with('error', 'Insufficient stock');
        }

        $validated['unit_price'] = $product->price;
        $validated['total_price'] = $product->price * $validated['quantity'];

        Sale::create($validated);
        $product->decreaseStock($validated['quantity']);

        return redirect()->route('sales.index')->with('success', 'Sale recorded successfully');
    }

    public function show(Sale $sale)
    {
        return view('sales.show', compact('sale'));
    }

    public function edit(Sale $sale)
    {
        $artisans = Artisan::where('status', 'active')->get();
        $customers = Customer::all();
        $products = Product::where('status', 'available')->get();

        return view('sales.edit', compact('sale', 'artisans', 'customers', 'products'));
    }

    public function update(Request $request, Sale $sale)
    {
        $validated = $request->validate([
            'payment_status' => 'required|in:pending,paid,failed',
            'notes' => 'nullable|string',
        ]);

        $sale->update($validated);
        return redirect()->route('sales.show', $sale)->with('success', 'Sale updated successfully');
    }

    public function destroy(Sale $sale)
    {
        $product = $sale->product;
        $product->increaseStock($sale->quantity);
        $sale->delete();

        return redirect()->route('sales.index')->with('success', 'Sale deleted and stock restored');
    }

    public function byArtisan($artisan_id)
    {
        $artisan = Artisan::find($artisan_id);
        $sales = Sale::where('artisan_id', $artisan_id)->with(['product', 'customer'])->get();

        return view('sales.by-artisan', compact('artisan', 'sales'));
    }

    public function byDateRange(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $sales = Sale::whereBetween('sale_date', [$startDate, $endDate])->with(['artisan', 'product', 'customer'])->get();

        return view('sales.by-date', compact('sales', 'startDate', 'endDate'));
    }

    public function statistics()
    {
        $totalSales = Sale::count();
        $totalRevenue = Sale::sum('total_price');
        $paidSales = Sale::where('payment_status', 'paid')->sum('total_price');
        $pendingSales = Sale::where('payment_status', 'pending')->sum('total_price');
        $averageSaleValue = Sale::avg('total_price');

        return view('sales.statistics', compact('totalSales', 'totalRevenue', 'paidSales', 'pendingSales', 'averageSaleValue'));
    }
}
