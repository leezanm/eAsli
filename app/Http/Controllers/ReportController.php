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
        $totalSales = Sale::count();
        $totalRevenue = Sale::sum('total_price');
        $totalProducts = Product::count();

        if (Auth::guard('artisan')->check()) {
            $reports = Report::where('artisan_id', Auth::guard('artisan')->user()->id)
                ->latest()
                ->paginate(10);
        } else {
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
            'artisan_id' => 'nullable|exists:artisans,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'format' => 'required|in:pdf,excel,json',
        ]);

        $query = Sale::whereBetween('sale_date', [$validated['start_date'], $validated['end_date']]);

        if ($validated['artisan_id']) {
            $query = $query->where('artisan_id', $validated['artisan_id']);
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
            'sales' => $sales,
        ];

        $report = Report::create([
            'artisan_id' => $validated['artisan_id'],
            'type' => 'sales',
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'content' => json_encode($content),
            'format' => $validated['format'],
        ]);

        return $this->exportReport($report, $validated['format']);
    }

    public function generateStockReport(Request $request)
    {
        $validated = $request->validate([
            'artisan_id' => 'nullable|exists:artisans,id',
            'format' => 'required|in:pdf,excel,json',
        ]);

        $query = Product::all();

        if ($validated['artisan_id']) {
            $query = Product::where('artisan_id', $validated['artisan_id'])->get();
        }

        $lowStockProducts = $query->filter(function ($product) {
            return $product->stock < 10;
        });

        $content = [
            'total_products' => count($query),
            'low_stock_count' => count($lowStockProducts),
            'low_stock_products' => $lowStockProducts,
            'generated_at' => now(),
        ];

        $report = Report::create([
            'artisan_id' => $validated['artisan_id'],
            'type' => 'stock',
            'start_date' => now()->format('Y-m-d'),
            'end_date' => now()->format('Y-m-d'),
            'content' => json_encode($content),
            'format' => $validated['format'],
        ]);

        return view('reports.show', compact('report', 'content'));
    }

    public function generatePerformanceReport(Request $request)
    {
        $validated = $request->validate([
            'artisan_id' => 'nullable|exists:artisans,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'format' => 'required|in:pdf,excel,json',
        ]);

        $artisans = $validated['artisan_id']
            ? [Artisan::find($validated['artisan_id'])]
            : Artisan::where('status', 'active')->get();

        $performanceData = [];
        foreach ($artisans as $artisan) {
            $sales = Sale::where('artisan_id', $artisan->id)
                ->whereBetween('sale_date', [$validated['start_date'], $validated['end_date']])
                ->get();

            $performanceData[] = [
                'artisan' => $artisan->name,
                'total_sales' => $sales->count(),
                'total_revenue' => $sales->sum('total_price'),
                'average_sale' => $sales->count() > 0 ? $sales->sum('total_price') / $sales->count() : 0,
                'products_sold' => $sales->sum('quantity'),
            ];
        }

        $report = Report::create([
            'artisan_id' => $validated['artisan_id'],
            'type' => 'performance',
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'content' => json_encode($performanceData),
            'format' => $validated['format'],
        ]);

        return view('reports.performance', compact('report', 'performanceData'));
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
