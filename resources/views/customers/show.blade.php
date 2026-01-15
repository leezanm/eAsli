@extends('layouts.app')

@section('title', 'Customer Details')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <!-- Page header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-neutral-900 flex items-center gap-3">
                <span class="inline-flex items-center justify-center w-11 h-11 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 text-white shadow-lg">
                    <i class="fas fa-user text-lg"></i>
                </span>
                <span>{{ $customer->name }}</span>
            </h1>
            <p class="mt-2 text-neutral-600 text-sm md:text-base flex items-center gap-2">
                <i class="fas fa-envelope text-neutral-500"></i>
                <span>{{ $customer->email }}</span>
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('customers.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-neutral-300 text-sm font-medium text-neutral-700 hover:bg-neutral-50 transition">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Customers</span>
            </a>
            <a href="{{ route('customers.edit', $customer) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary-600 text-sm font-semibold text-white shadow-sm hover:bg-primary-700 transition">
                <i class="fas fa-user-edit"></i>
                <span>Edit Customer</span>
            </a>
        </div>
    </div>

    <!-- Customer info + stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <!-- Customer info -->
        <div class="md:col-span-1 bg-white rounded-2xl shadow-md border border-secondary-200 p-6 flex flex-col gap-3">
            <h2 class="text-sm font-semibold text-neutral-700 uppercase tracking-wide mb-2 flex items-center gap-2">
                <i class="fas fa-id-card text-primary-500"></i>
                <span>Profile</span>
            </h2>
            <div class="space-y-2 text-sm text-neutral-700">
                <p class="flex items-center gap-2">
                    <span class="w-5 text-neutral-400"><i class="fas fa-phone"></i></span>
                    <span>{{ $customer->phone ?? '-' }}</span>
                </p>
                <p class="flex items-start gap-2">
                    <span class="w-5 mt-0.5 text-neutral-400"><i class="fas fa-map-marker-alt"></i></span>
                    <span>{{ $customer->address ?? 'No address provided' }}</span>
                </p>
            </div>
        </div>

        <!-- Stats cards -->
        <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="bg-white rounded-2xl shadow-md border border-secondary-200 p-5 flex flex-col gap-2">
                <div class="flex items-center justify-between mb-1">
                    <p class="text-xs font-semibold text-neutral-600 uppercase tracking-wider">Total Orders</p>
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-primary-50 text-primary-600">
                        <i class="fas fa-shopping-bag text-sm"></i>
                    </span>
                </div>
                <p class="text-2xl font-bold text-neutral-900">{{ $totalOrders }}</p>
            </div>

            <div class="bg-white rounded-2xl shadow-md border border-secondary-200 p-5 flex flex-col gap-2">
                <div class="flex items-center justify-between mb-1">
                    <p class="text-xs font-semibold text-neutral-600 uppercase tracking-wider">Total Spent</p>
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-accent-50 text-accent-600">
                        <i class="fas fa-coins text-sm"></i>
                    </span>
                </div>
                <p class="text-2xl font-bold text-neutral-900">RM {{ number_format($totalSpent, 2) }}</p>
            </div>
        </div>
    </div>

    <!-- Purchase history -->
    <div class="bg-white rounded-2xl shadow-md border border-secondary-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-neutral-200 flex items-center justify-between">
            <h2 class="text-base font-semibold text-neutral-900 flex items-center gap-2">
                <i class="fas fa-receipt text-primary-500"></i>
                <span>Purchase History</span>
            </h2>
            <p class="text-xs text-neutral-500">Showing {{ $sales->count() }} orders</p>
        </div>
        @if($sales->isEmpty())
            <div class="px-6 py-10 text-center text-neutral-500 text-sm">
                <i class="fas fa-info-circle mb-2 text-neutral-400"></i>
                <p>This customer has no completed orders yet.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-neutral-200 text-sm">
                    <thead class="bg-secondary-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wider">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wider">Artisan</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wider">Quantity</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wider">Total (RM)</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-neutral-100">
                        @foreach($sales as $sale)
                            <tr class="hover:bg-secondary-50/70 transition">
                                <td class="px-6 py-3 whitespace-nowrap text-neutral-700">
                                    {{ optional($sale->sale_date)->format('d M Y') ?? $sale->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-3 whitespace-nowrap text-neutral-800">
                                    {{ $sale->product->name ?? 'Unknown product' }}
                                </td>
                                <td class="px-6 py-3 whitespace-nowrap text-neutral-700">
                                    {{ $sale->artisan->business_name ?? $sale->artisan->name ?? 'Unknown artisan' }}
                                </td>
                                <td class="px-6 py-3 whitespace-nowrap text-neutral-700">{{ $sale->quantity }}</td>
                                <td class="px-6 py-3 whitespace-nowrap text-neutral-800">RM {{ number_format($sale->total_price, 2) }}</td>
                                <td class="px-6 py-3 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                        @if($sale->payment_status === 'paid') bg-emerald-50 text-emerald-700
                                        @elseif($sale->payment_status === 'pending') bg-amber-50 text-amber-700
                                        @else bg-neutral-100 text-neutral-700 @endif">
                                        {{ ucfirst($sale->payment_status ?? 'unknown') }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
