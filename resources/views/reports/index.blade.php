@extends('layouts.app')

@section('title', 'Reports')

@section('content')
<div class="bg-gradient-to-br from-neutral-100 to-neutral-50 min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-primary-800 flex items-center gap-3">
                    <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-primary-100 text-primary-700">
                        <i class="fas fa-chart-bar"></i>
                    </span>
                    Reports
                </h1>
                <p class="mt-2 text-neutral-600">
                    Generate downloadable business reports and view key summaries.
                </p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 rounded-lg border border-neutral-300 text-neutral-700 hover:bg-neutral-100 text-sm font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Admin Dashboard
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">
            <!-- Generate Reports -->
            <div class="bg-white rounded-2xl shadow-sm border border-neutral-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-neutral-100 flex items-center gap-2">
                    <i class="fas fa-cog text-primary-600"></i>
                    <h2 class="text-sm font-semibold text-neutral-900 uppercase tracking-wide">Generate Reports</h2>
                </div>
                <div class="p-6 space-y-6 text-sm">
                    <!-- Sales Report -->
                    <form method="POST" action="{{ route('reports.sales') }}" class="space-y-4">
                        @csrf
                        <div>
                            <h3 class="text-base font-semibold text-neutral-900 flex items-center gap-2">
                                <i class="fas fa-receipt text-primary-600"></i>
                                Sales Report
                            </h3>
                            <p class="text-xs text-neutral-500 mt-1">Download sales data for a specific date range.</p>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="start_date" class="block text-xs font-semibold text-neutral-600 uppercase mb-1">Start date</label>
                                <input type="date" id="start_date" name="start_date" class="w-full px-3 py-2 rounded-lg border border-neutral-300 text-sm focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none">
                            </div>
                            <div>
                                <label for="end_date" class="block text-xs font-semibold text-neutral-600 uppercase mb-1">End date</label>
                                <input type="date" id="end_date" name="end_date" class="w-full px-3 py-2 rounded-lg border border-neutral-300 text-sm focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none">
                            </div>
                        </div>
                        <button type="submit" class="inline-flex items-center justify-center w-full px-4 py-2.5 rounded-lg bg-primary-600 hover:bg-primary-700 text-white font-semibold text-sm shadow">
                            <i class="fas fa-file-csv mr-2"></i>
                            Generate Sales Report (CSV)
                        </button>
                    </form>

                    <hr class="border-neutral-200">

                    <!-- Stock Report -->
                    <form method="POST" action="{{ route('reports.stock') }}" class="space-y-3">
                        @csrf
                        <div>
                            <h3 class="text-base font-semibold text-neutral-900 flex items-center gap-2">
                                <i class="fas fa-boxes-stacked text-primary-600"></i>
                                Stock Report
                            </h3>
                            <p class="text-xs text-neutral-500 mt-1">Export current product stock levels.</p>
                        </div>
                        <button type="submit" class="inline-flex items-center justify-center w-full px-4 py-2.5 rounded-lg bg-primary-600 hover:bg-primary-700 text-white font-semibold text-sm shadow">
                            <i class="fas fa-file-csv mr-2"></i>
                            Generate Stock Report (CSV)
                        </button>
                    </form>

                    <hr class="border-neutral-200">

                    <!-- Performance Report -->
                    <form method="POST" action="{{ route('reports.performance') }}" class="space-y-3">
                        @csrf
                        <div>
                            <h3 class="text-base font-semibold text-neutral-900 flex items-center gap-2">
                                <i class="fas fa-chart-line text-primary-600"></i>
                                Performance Report
                            </h3>
                            <p class="text-xs text-neutral-500 mt-1">Summarize overall marketplace and artisan performance.</p>
                        </div>
                        <button type="submit" class="inline-flex items-center justify-center w-full px-4 py-2.5 rounded-lg bg-primary-600 hover:bg-primary-700 text-white font-semibold text-sm shadow">
                            <i class="fas fa-file-csv mr-2"></i>
                            Generate Performance Report (CSV)
                        </button>
                    </form>
                </div>
            </div>

            <!-- Reports Summary -->
            <div class="bg-white rounded-2xl shadow-sm border border-neutral-100 p-6 flex flex-col justify-between">
                <div class="grid grid-cols-1 gap-4">
                    <div class="bg-neutral-50 rounded-xl p-5 flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold tracking-wide text-neutral-500 uppercase">Total Sales</p>
                            <p class="mt-2 text-2xl font-bold text-primary-800">{{ $totalSales }}</p>
                        </div>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary-100 text-primary-700">
                            <i class="fas fa-receipt"></i>
                        </span>
                    </div>

                    <div class="bg-neutral-50 rounded-xl p-5 flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold tracking-wide text-neutral-500 uppercase">Total Revenue</p>
                            <p class="mt-2 text-2xl font-bold text-primary-800">RM {{ number_format($totalRevenue, 2) }}</p>
                        </div>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary-100 text-primary-700">
                            <i class="fas fa-chart-line"></i>
                        </span>
                    </div>

                    <div class="bg-neutral-50 rounded-xl p-5 flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold tracking-wide text-neutral-500 uppercase">Total Products</p>
                            <p class="mt-2 text-2xl font-bold text-primary-800">{{ $totalProducts }}</p>
                        </div>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary-100 text-primary-700">
                            <i class="fas fa-box"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Reports -->
        @if($reports->isNotEmpty())
            <div class="bg-white rounded-2xl shadow-sm border border-neutral-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-neutral-100 flex items-center justify-between">
                    <h2 class="text-sm font-semibold text-neutral-900 uppercase tracking-wide flex items-center gap-2">
                        <i class="fas fa-history text-primary-600"></i>
                        Recent Reports
                    </h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-neutral-200 text-sm">
                        <thead class="bg-neutral-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wide">Type</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wide">Date</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wide">Status</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold text-neutral-600 uppercase tracking-wide">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-100">
                            @foreach($reports as $report)
                                <tr class="hover:bg-neutral-50/70">
                                    <td class="px-4 py-3 align-top text-neutral-800">
                                        <span class="inline-flex items-center gap-2">
                                            <i class="fas fa-file-alt text-primary-600"></i>
                                            {{ ucfirst(str_replace('_', ' ', $report->report_type)) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 align-top text-neutral-800">{{ $report->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-3 align-top">
                                        @php
                                            $isGenerated = ($report->status ?? '') === 'generated';
                                            $statusLabel = $isGenerated ? 'Ready' : 'Processing';
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                            {{ $isGenerated ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-amber-50 text-amber-700 border border-amber-100' }}">
                                            <span class="w-1.5 h-1.5 rounded-full mr-1.5 {{ $isGenerated ? 'bg-emerald-500' : 'bg-amber-400' }}"></span>
                                            {{ $statusLabel }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 align-top text-right whitespace-nowrap">
                                        <a href="{{ route('reports.show', $report) }}" class="inline-flex items-center px-3 py-1.5 rounded-lg border border-neutral-200 text-xs font-semibold text-neutral-700 hover:bg-neutral-50">
                                            <i class="fas fa-download mr-1.5"></i>
                                            Download
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
