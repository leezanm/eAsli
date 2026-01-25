@extends('layouts.app')

@section('title', 'Report Details')

@section('content')
<div class="bg-gradient-to-br from-neutral-100 to-neutral-50 min-h-screen py-10">
    <div class="max-w-6xl mx-auto px-4">
        @php
            /** @var \App\Models\Report $report */
            $content = $content ?? json_decode($report->content ?? '[]', true);
            $typeLabel = ucfirst(str_replace('_', ' ', $report->type ?? 'report'));
        @endphp

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-primary-800 flex items-center gap-3">
                    <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-primary-100 text-primary-700">
                        <i class="fas fa-file-alt"></i>
                    </span>
                    Report Details
                </h1>
                <p class="mt-2 text-neutral-600 text-sm md:text-base">
                    {{ $typeLabel }} report generated on {{ $report->created_at?->format('d M Y, H:i') }}.
                </p>
            </div>
            <div class="flex flex-wrap gap-3 justify-end">
                <a href="{{ route('reports.index') }}" class="inline-flex items-center px-4 py-2 rounded-lg border border-neutral-300 text-neutral-700 hover:bg-neutral-100 text-sm font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Reports
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Meta card -->
            <div class="bg-white rounded-2xl shadow-sm border border-neutral-100 p-6 space-y-4 lg:col-span-1">
                <h2 class="text-sm font-semibold text-neutral-900 uppercase tracking-wide mb-2 flex items-center gap-2">
                    <i class="fas fa-info-circle text-primary-600"></i>
                    Report Information
                </h2>
                <dl class="text-sm space-y-2">
                    <div class="flex justify-between gap-4">
                        <dt class="text-neutral-500">Type</dt>
                        <dd class="font-medium text-neutral-900">{{ $typeLabel }}</dd>
                    </div>
                    <div class="flex justify-between gap-4">
                        <dt class="text-neutral-500">Format</dt>
                        <dd class="font-medium text-neutral-900">{{ strtoupper($report->format ?? 'N/A') }}</dd>
                    </div>
                    <div class="flex justify-between gap-4">
                        <dt class="text-neutral-500">Start date</dt>
                        <dd class="font-medium text-neutral-900">{{ $report->start_date?->format('d M Y') ?? '-' }}</dd>
                    </div>
                    <div class="flex justify-between gap-4">
                        <dt class="text-neutral-500">End date</dt>
                        <dd class="font-medium text-neutral-900">{{ $report->end_date?->format('d M Y') ?? '-' }}</dd>
                    </div>
                    <div class="flex justify-between gap-4">
                        <dt class="text-neutral-500">Created at</dt>
                        <dd class="font-medium text-neutral-900">{{ $report->created_at?->format('d M Y, H:i') ?? '-' }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Summary card(s) -->
            <div class="bg-white rounded-2xl shadow-sm border border-neutral-100 p-6 lg:col-span-2">
                <h2 class="text-sm font-semibold text-neutral-900 uppercase tracking-wide mb-4 flex items-center gap-2">
                    <i class="fas fa-chart-line text-primary-600"></i>
                    Summary
                </h2>

                @if(($report->type ?? '') === 'sales')
                    @php
                        $summary = $content ?? [];
                    @endphp
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-sm">
                        <div class="bg-neutral-50 rounded-xl p-4 flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold text-neutral-500 uppercase tracking-wide">Total Revenue</p>
                                <p class="mt-2 text-xl font-bold text-primary-800">RM {{ number_format($summary['total_revenue'] ?? 0, 2) }}</p>
                            </div>
                            <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-primary-100 text-primary-700">
                                <i class="fas fa-coins"></i>
                            </span>
                        </div>
                        <div class="bg-neutral-50 rounded-xl p-4 flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold text-neutral-500 uppercase tracking-wide">Transactions</p>
                                <p class="mt-2 text-xl font-bold text-primary-800">{{ $summary['total_transactions'] ?? 0 }}</p>
                            </div>
                            <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-primary-100 text-primary-700">
                                <i class="fas fa-receipt"></i>
                            </span>
                        </div>
                        <div class="bg-neutral-50 rounded-xl p-4 flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold text-neutral-500 uppercase tracking-wide">Total Quantity</p>
                                <p class="mt-2 text-xl font-bold text-primary-800">{{ $summary['total_quantity'] ?? 0 }}</p>
                            </div>
                            <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-primary-100 text-primary-700">
                                <i class="fas fa-box"></i>
                            </span>
                        </div>
                        <div class="bg-neutral-50 rounded-xl p-4 flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold text-neutral-500 uppercase tracking-wide">Avg. Transaction</p>
                                <p class="mt-2 text-xl font-bold text-primary-800">RM {{ number_format($summary['average_transaction'] ?? 0, 2) }}</p>
                            </div>
                            <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-primary-100 text-primary-700">
                                <i class="fas fa-chart-bar"></i>
                            </span>
                        </div>
                    </div>
                @elseif(($report->type ?? '') === 'stock')
                    @php
                        $summary = $content ?? [];
                    @endphp
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                        <div class="bg-neutral-50 rounded-xl p-4 flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold text-neutral-500 uppercase tracking-wide">Total Products</p>
                                <p class="mt-2 text-xl font-bold text-primary-800">{{ $summary['total_products'] ?? 0 }}</p>
                            </div>
                            <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-primary-100 text-primary-700">
                                <i class="fas fa-box"></i>
                            </span>
                        </div>
                        <div class="bg-neutral-50 rounded-xl p-4 flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold text-neutral-500 uppercase tracking-wide">Low Stock Items</p>
                                <p class="mt-2 text-xl font-bold text-primary-800">{{ $summary['low_stock_count'] ?? 0 }}</p>
                            </div>
                            <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-amber-100 text-amber-700">
                                <i class="fas fa-triangle-exclamation"></i>
                            </span>
                        </div>
                        <div class="bg-neutral-50 rounded-xl p-4 flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold text-neutral-500 uppercase tracking-wide">Generated At</p>
                                <p class="mt-2 text-sm font-semibold text-primary-800">{{ isset($summary['generated_at']) ? \Carbon\Carbon::parse($summary['generated_at'])->format('d M Y, H:i') : '-' }}</p>
                            </div>
                            <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-primary-100 text-primary-700">
                                <i class="fas fa-clock"></i>
                            </span>
                        </div>
                    </div>
                @else
                    <p class="text-sm text-neutral-600">No structured summary is available for this report type. See the raw data below.</p>
                @endif
            </div>
        </div>

        <!-- Detailed Report Data -->
        @if($report->type === 'sales' && isset($content['sales']))
            <!-- Sales Report Details -->
            <div class="bg-white rounded-2xl shadow-sm border border-neutral-100 p-6 mb-6">
                <h2 class="text-sm font-semibold text-neutral-900 uppercase tracking-wide mb-4 flex items-center gap-2">
                    <i class="fas fa-receipt text-primary-600"></i>
                    Sales Transactions
                </h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-neutral-200">
                                <th class="px-4 py-3 text-left font-semibold text-neutral-700">Date</th>
                                <th class="px-4 py-3 text-left font-semibold text-neutral-700">Product</th>
                                <th class="px-4 py-3 text-left font-semibold text-neutral-700">Customer</th>
                                <th class="px-4 py-3 text-left font-semibold text-neutral-700">Artisan</th>
                                <th class="px-4 py-3 text-right font-semibold text-neutral-700">Qty</th>
                                <th class="px-4 py-3 text-right font-semibold text-neutral-700">Unit Price</th>
                                <th class="px-4 py-3 text-right font-semibold text-neutral-700">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-100">
                            @forelse($content['sales'] as $sale)
                                <tr class="hover:bg-neutral-50">
                                    <td class="px-4 py-3 text-neutral-600">
                                        @if(is_object($sale))
                                            {{ $sale->created_at?->format('d M Y') ?? '-' }}
                                        @else
                                            {{ isset($sale['created_at']) ? \Carbon\Carbon::parse($sale['created_at'])->format('d M Y') : '-' }}
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-neutral-900 font-medium">
                                        @if(is_object($sale) && $sale->product)
                                            {{ $sale->product->name ?? '-' }}
                                        @elseif(isset($sale['product']['name']))
                                            {{ $sale['product']['name'] }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-neutral-600">
                                        @if(is_object($sale) && $sale->customer)
                                            {{ $sale->customer->name ?? '-' }}
                                        @elseif(isset($sale['customer']['name']))
                                            {{ $sale['customer']['name'] }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-neutral-600">
                                        @if(is_object($sale) && $sale->artisan)
                                            {{ $sale->artisan->name ?? '-' }}
                                        @elseif(isset($sale['artisan']['name']))
                                            {{ $sale['artisan']['name'] }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-right text-neutral-600">
                                        @if(is_object($sale))
                                            {{ $sale->quantity ?? '-' }}
                                        @else
                                            {{ $sale['quantity'] ?? '-' }}
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-right text-neutral-600">
                                        @if(is_object($sale))
                                            RM {{ number_format($sale->unit_price ?? 0, 2) }}
                                        @else
                                            RM {{ number_format($sale['unit_price'] ?? 0, 2) }}
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-right font-semibold text-primary-700">
                                        @if(is_object($sale))
                                            RM {{ number_format($sale->total_price ?? 0, 2) }}
                                        @else
                                            RM {{ number_format($sale['total_price'] ?? 0, 2) }}
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-8 text-center text-neutral-500">No sales data available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @elseif($report->type === 'stock' && isset($content['low_stock_products']))
            <!-- Stock Report Details -->
            <div class="bg-white rounded-2xl shadow-sm border border-neutral-100 p-6 mb-6">
                <h2 class="text-sm font-semibold text-neutral-900 uppercase tracking-wide mb-4 flex items-center gap-2">
                    <i class="fas fa-box text-amber-600"></i>
                    Product Inventory
                </h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-neutral-200">
                                <th class="px-4 py-3 text-left font-semibold text-neutral-700">Product Name</th>
                                <th class="px-4 py-3 text-left font-semibold text-neutral-700">Category</th>
                                <th class="px-4 py-3 text-right font-semibold text-neutral-700">Current Stock</th>
                                <th class="px-4 py-3 text-right font-semibold text-neutral-700">Price</th>
                                <th class="px-4 py-3 text-center font-semibold text-neutral-700">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-100">
                            @forelse($content['low_stock_products'] as $product)
                                <tr class="hover:bg-neutral-50">
                                    <td class="px-4 py-3 text-neutral-900 font-medium">
                                        @if(is_object($product))
                                            {{ $product->name ?? '-' }}
                                        @else
                                            {{ $product['name'] ?? '-' }}
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-neutral-600">
                                        @if(is_object($product))
                                            {{ $product->category ?? '-' }}
                                        @else
                                            {{ $product['category'] ?? '-' }}
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-right font-semibold">
                                        @php
                                            $stock = is_object($product) ? $product->stock : $product['stock'];
                                        @endphp
                                        <span class="inline-flex px-3 py-1 rounded-full {{ $stock < 5 ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700' }}">
                                            {{ $stock }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-right text-neutral-600">
                                        @if(is_object($product))
                                            RM {{ number_format($product->price ?? 0, 2) }}
                                        @else
                                            RM {{ number_format($product['price'] ?? 0, 2) }}
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @php
                                            $stock = is_object($product) ? $product->stock : $product['stock'];
                                        @endphp
                                        @if($stock < 5)
                                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                                <i class="fas fa-exclamation-circle"></i>
                                                Critical
                                            </span>
                                        @elseif($stock < 10)
                                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-amber-100 text-amber-700 text-xs font-semibold">
                                                <i class="fas fa-triangle-exclamation"></i>
                                                Low
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                                <i class="fas fa-check-circle"></i>
                                                Good
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-neutral-500">All products have adequate stock</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @elseif($report->type === 'performance' && isset($content['artisans']))
            <!-- Performance Report Details -->
            <div class="bg-white rounded-2xl shadow-sm border border-neutral-100 p-6 mb-6">
                <h2 class="text-sm font-semibold text-neutral-900 uppercase tracking-wide mb-4 flex items-center gap-2">
                    <i class="fas fa-chart-line text-primary-600"></i>
                    Artisan Performance
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @forelse($content['artisans'] as $artisan)
                        <div class="bg-neutral-50 rounded-xl border border-neutral-200 p-4">
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <h3 class="font-semibold text-neutral-900">
                                        @if(is_object($artisan))
                                            {{ $artisan->name ?? '-' }}
                                        @else
                                            {{ $artisan['name'] ?? '-' }}
                                        @endif
                                    </h3>
                                    <p class="text-xs text-neutral-500 mt-1">
                                        @if(is_object($artisan))
                                            {{ $artisan->specialty ?? '-' }}
                                        @else
                                            {{ $artisan['specialty'] ?? '-' }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-neutral-600">Total Sales:</span>
                                    <span class="font-semibold text-neutral-900">
                                        @if(is_object($artisan))
                                            {{ $artisan->total_sales ?? 0 }}
                                        @else
                                            {{ $artisan['total_sales'] ?? 0 }}
                                        @endif
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-neutral-600">Total Revenue:</span>
                                    <span class="font-semibold text-primary-700">
                                        @if(is_object($artisan))
                                            RM {{ number_format($artisan->total_revenue ?? 0, 2) }}
                                        @else
                                            RM {{ number_format($artisan['total_revenue'] ?? 0, 2) }}
                                        @endif
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-neutral-600">Total Quantity:</span>
                                    <span class="font-semibold text-neutral-900">
                                        @if(is_object($artisan))
                                            {{ $artisan->total_quantity ?? 0 }}
                                        @else
                                            {{ $artisan['total_quantity'] ?? 0 }}
                                        @endif
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-neutral-600">Avg. Transaction:</span>
                                    <span class="font-semibold text-neutral-900">
                                        @if(is_object($artisan))
                                            RM {{ number_format($artisan->average_transaction ?? 0, 2) }}
                                        @else
                                            RM {{ number_format($artisan['average_transaction'] ?? 0, 2) }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 px-4 py-8 text-center text-neutral-500">No performance data available</div>
                    @endforelse
                </div>
            </div>
        @else
            <!-- Fallback: Raw data for unknown report types -->
            <div class="bg-white rounded-2xl shadow-sm border border-neutral-100 p-6 mb-6">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="text-sm font-semibold text-neutral-900 uppercase tracking-wide flex items-center gap-2">
                        <i class="fas fa-code text-primary-600"></i>
                        Raw Report Data (JSON)
                    </h2>
                </div>
                <pre class="text-xs bg-neutral-950 text-neutral-50 rounded-xl p-4 overflow-x-auto"><code>{{ json_encode($content, JSON_PRETTY_PRINT) }}</code></pre>
            </div>
        @endif
    </div>
</div>
@endsection
