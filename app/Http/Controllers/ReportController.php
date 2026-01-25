<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        if (Auth::guard('artisan')->check()) {
            $artisanId = Auth::guard('artisan')->user()->id;
            $totalSales = Sale::where('artisan_id', $artisanId)->count();
            $totalRevenue = Sale::where('artisan_id', $artisanId)->sum('total_price');
            $totalProducts = Sale::where('artisan_id', $artisanId)->distinct('product_id')->count('product_id');
            $reports = Report::where('artisan_id', $artisanId)
                ->latest()
                ->paginate(10);
        } else {
            $totalSales = Sale::count();
            $totalRevenue = Sale::sum('total_price');
            $totalProducts = Product::count();
            $reports = Report::latest()->paginate(10);
        }

        return view('reports.index', compact('totalSales', 'totalRevenue', 'totalProducts', 'reports'));
    }

    public function create()
    {
        $artisans = Artisan::where('status', 'active')->get();
        return view('reports.create', compact('artisans'));
    }

    public function generateSalesReport(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'format' => 'nullable|in:pdf,excel,json',
        ]);

        $format = $validated['format'] ?? 'json';

        $query = Sale::whereBetween('sale_date', [$validated['start_date'], $validated['end_date']]);

        // Filter by artisan if logged in as artisan
        if (Auth::guard('artisan')->check()) {
            $query->where('artisan_id', Auth::guard('artisan')->user()->id);
        }

        $sales = $query->with(['artisan', 'product', 'customer'])->get();
        $totalRevenue = $sales->sum('total_price');
        $totalQuantity = $sales->sum('quantity');
        $totalTransactions = $sales->count();

        $content = [
            'period' => $validated['start_date'] . ' to ' . $validated['end_date'],
            'total_revenue' => $totalRevenue,
            'total_quantity' => $totalQuantity,
            'total_transactions' => $totalTransactions,
            'average_transaction' => $totalTransactions > 0 ? $totalRevenue / $totalTransactions : 0,
            'sales' => $sales->map(function($sale) {
                return [
                    'id' => $sale->id,
                    'sale_date' => $sale->sale_date,
                    'created_at' => $sale->created_at?->toIso8601String(),
                    'quantity' => $sale->quantity,
                    'unit_price' => $sale->unit_price,
                    'total_price' => $sale->total_price,
                    'product' => [
                        'id' => $sale->product?->id,
                        'name' => $sale->product?->name,
                        'category' => $sale->product?->category,
                    ],
                    'customer' => [
                        'id' => $sale->customer?->id,
                        'name' => $sale->customer?->name,
                        'email' => $sale->customer?->email,
                    ],
                    'artisan' => [
                        'id' => $sale->artisan?->id,
                        'name' => $sale->artisan?->name,
                    ],
                ];
            })->toArray(),
        ];

        $report = Report::create([
            'artisan_id' => Auth::guard('artisan')->check() ? Auth::guard('artisan')->user()->id : null,
            'type' => 'sales',
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'content' => json_encode($content),
        ]);

        return redirect()->route('reports.index')->with('success', 'Sales Report generated successfully!');
    }

    public function generateStockReport(Request $request)
    {
        $validated = $request->validate([
            'format' => 'nullable|in:pdf,excel,json',
        ]);

        $format = $validated['format'] ?? 'json';

        // Filter products by artisan if logged in as artisan
        $query = Product::query();
        if (Auth::guard('artisan')->check()) {
            $query->where('artisan_id', Auth::guard('artisan')->user()->id);
        }
        $products = $query->get();

        $lowStockProducts = $products->filter(function ($product) {
            return $product->stock < 10;
        })->values();

        $content = [
            'total_products' => $products->count(),
            'low_stock_count' => $lowStockProducts->count(),
            'low_stock_products' => $lowStockProducts->map(function($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'category' => $product->category,
                    'stock' => $product->stock,
                    'price' => $product->price,
                ];
            })->toArray(),
            'generated_at' => now()->toIso8601String(),
        ];

        $report = Report::create([
            'artisan_id' => Auth::guard('artisan')->check() ? Auth::guard('artisan')->user()->id : null,
            'type' => 'stock',
            'start_date' => now()->format('Y-m-d'),
            'end_date' => now()->format('Y-m-d'),
            'content' => json_encode($content),
        ]);

        return redirect()->route('reports.index')->with('success', 'Stock Report generated successfully!');
    }

    public function generatePerformanceReport(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'format' => 'nullable|in:pdf,excel,json',
        ]);

        $format = $validated['format'] ?? 'json';

        // If artisan is logged in, show only their performance data
        $query = \App\Models\Artisan::where('status', 'active');
        if (Auth::guard('artisan')->check()) {
            $query->where('id', Auth::guard('artisan')->user()->id);
        }
        $artisans = $query->get();

        $performanceData = $artisans->map(function($artisan) use ($validated) {
            $sales = Sale::where('artisan_id', $artisan->id)
                ->whereBetween('sale_date', [$validated['start_date'], $validated['end_date']])
                ->get();

            return [
                'artisan_id' => $artisan->id,
                'name' => $artisan->name,
                'specialty' => $artisan->specialty ?? '-',
                'total_sales' => $sales->count(),
                'total_revenue' => $sales->sum('total_price'),
                'total_quantity' => $sales->sum('quantity'),
                'average_transaction' => $sales->count() > 0 ? $sales->sum('total_price') / $sales->count() : 0,
            ];
        })->toArray();

        // Wrap in array for consistency with other reports
        $content = [
            'period' => $validated['start_date'] . ' to ' . $validated['end_date'],
            'artisans' => $performanceData,
        ];

        $report = Report::create([
            'artisan_id' => Auth::guard('artisan')->check() ? Auth::guard('artisan')->user()->id : null,
            'type' => 'performance',
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'content' => json_encode($content),
        ]);

        return redirect()->route('reports.index')->with('success', 'Performance Report generated successfully!');
    }

    public function show(Report $report)
    {
        $content = json_decode($report->content, true);
        return view('reports.show', compact('report', 'content'));
    }

    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Report deleted successfully');
    }

    private function exportReport(Report $report, $format)
    {
        // Placeholder for export logic
        // In production, use packages like maatwebsite/excel or barryvdh/laravel-dompdf

        if ($format === 'json') {
            return response()->json(json_decode($report->content));
        }

        return view('reports.show', compact('report'));
    }
}
