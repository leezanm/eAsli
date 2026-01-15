@extends('layouts.app')

@section('title', 'Customers')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <!-- Page header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-neutral-900 flex items-center gap-3">
                <span class="inline-flex items-center justify-center w-11 h-11 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 text-white shadow-lg">
                    <i class="fas fa-users text-lg"></i>
                </span>
                <span>Customers</span>
            </h1>
            <p class="mt-2 text-neutral-600 text-sm md:text-base">Overview of your customer base and key insights.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-neutral-300 text-sm font-medium text-neutral-700 hover:bg-neutral-50 transition">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Admin Dashboard</span>
            </a>
        </div>
    </div>

    <!-- Stats cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">
        <div class="bg-white rounded-2xl shadow-md border border-secondary-200 p-5 flex flex-col gap-2">
            <div class="flex items-center justify-between mb-1">
                <p class="text-xs font-semibold text-neutral-600 uppercase tracking-wider">Total Customers</p>
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-primary-50 text-primary-600">
                    <i class="fas fa-user-tie text-sm"></i>
                </span>
            </div>
            <p class="text-2xl font-bold text-neutral-900">{{ $totalCustomers }}</p>
        </div>

        <div class="bg-white rounded-2xl shadow-md border border-secondary-200 p-5 flex flex-col gap-2">
            <div class="flex items-center justify-between mb-1">
                <p class="text-xs font-semibold text-neutral-600 uppercase tracking-wider">Top Customers</p>
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-accent-50 text-accent-600">
                    <i class="fas fa-star text-sm"></i>
                </span>
            </div>
            <p class="text-2xl font-bold text-neutral-900">{{ $topCustomersCount }}</p>
        </div>

        <div class="bg-white rounded-2xl shadow-md border border-secondary-200 p-5 flex flex-col gap-2">
            <div class="flex items-center justify-between mb-1">
                <p class="text-xs font-semibold text-neutral-600 uppercase tracking-wider">Average Spend</p>
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-primary-50 text-primary-600">
                    <i class="fas fa-chart-line text-sm"></i>
                </span>
            </div>
            <p class="text-2xl font-bold text-neutral-900">RM {{ number_format($averageSpend, 2) }}</p>
        </div>

        <div class="bg-white rounded-2xl shadow-md border border-secondary-200 p-5 flex flex-col gap-2">
            <div class="flex items-center justify-between mb-1">
                <p class="text-xs font-semibold text-neutral-600 uppercase tracking-wider">Average Orders</p>
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-primary-50 text-primary-600">
                    <i class="fas fa-shopping-cart text-sm"></i>
                </span>
            </div>
            <p class="text-2xl font-bold text-neutral-900">{{ number_format($averageOrders, 1) }}</p>
        </div>
    </div>

    <!-- Top Customers table -->
    <div class="bg-white rounded-2xl shadow-md border border-secondary-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-neutral-200 flex items-center justify-between">
            <h2 class="text-base font-semibold text-neutral-900 flex items-center gap-2">
                <i class="fas fa-trophy text-accent-500"></i>
                <span>Top Customers</span>
            </h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-neutral-200 text-sm">
                <thead class="bg-secondary-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wider">Orders</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wider">Total Spend (RM)</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-neutral-100">
                    @foreach($topCustomers as $customer)
                        <tr class="hover:bg-secondary-50/70 transition">
                            <td class="px-6 py-3 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-primary-50 text-primary-700">
                                        <i class="fas fa-user-circle"></i>
                                    </span>
                                    <span class="font-medium text-neutral-900">{{ $customer->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-neutral-700">{{ $customer->email }}</td>
                            <td class="px-6 py-3 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-primary-50 text-primary-700">
                                    {{ $customer->sales_count ?? 0 }}
                                </span>
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-neutral-800">RM {{ number_format($customer->sales_sum_total_price ?? 0, 2) }}</td>
                            <td class="px-6 py-3 whitespace-nowrap">
                                <a href="{{ route('customers.show', $customer) }}" class="inline-flex items-center gap-2 text-xs font-semibold text-primary-700 hover:text-primary-800">
                                    <i class="fas fa-eye"></i>
                                    <span>View</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
