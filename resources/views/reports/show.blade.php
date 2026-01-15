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

        <!-- Raw content -->
        <div class="bg-white rounded-2xl shadow-sm border border-neutral-100 p-6 mb-6">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-sm font-semibold text-neutral-900 uppercase tracking-wide flex items-center gap-2">
                    <i class="fas fa-code text-primary-600"></i>
                    Raw Report Data (JSON)
                </h2>
            </div>
            <pre class="text-xs bg-neutral-950 text-neutral-50 rounded-xl p-4 overflow-x-auto"><code>{{ json_encode($content, JSON_PRETTY_PRINT) }}</code></pre>
        </div>
    </div>
</div>
@endsection
