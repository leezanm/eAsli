@extends('layouts.app')

@section('title', 'Artisan Dashboard')

@section('content')
<div class="bg-gradient-to-br from-neutral-100 to-neutral-50 min-h-screen py-10">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-primary-800 flex items-center gap-3">
                    <span class="inline-flex items-center justify-center w-11 h-11 rounded-full bg-primary-100 text-primary-700">
                        <i class="fas fa-tachometer-alt"></i>
                    </span>
                    Artisan Dashboard
                </h1>
                <p class="mt-2 text-neutral-600 text-sm md:text-base">
                    Welcome back, {{ auth('artisan')->user()->name }}. Here is a quick overview of your business.
                </p>
            </div>
            <div class="flex flex-wrap gap-3 justify-end">
                <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 rounded-lg border border-neutral-300 text-neutral-700 hover:bg-neutral-100 text-sm font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Home
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
            <div class="bg-white rounded-2xl shadow-sm border border-neutral-100 p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-xs font-semibold text-neutral-500 uppercase tracking-wide">Shops</p>
                        <p class="mt-2 text-3xl font-bold text-primary-800">{{ $shopCount }}</p>
                    </div>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary-100 text-primary-700">
                        <i class="fas fa-shop"></i>
                    </span>
                </div>
                <div class="mt-4">
                    <a href="{{ route('shops.index') }}" class="inline-flex items-center text-xs font-medium text-primary-700 hover:text-primary-900">
                        View shops
                        <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-neutral-100 p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-xs font-semibold text-neutral-500 uppercase tracking-wide">Products</p>
                        <p class="mt-2 text-3xl font-bold text-primary-800">{{ $productCount }}</p>
                    </div>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary-100 text-primary-700">
                        <i class="fas fa-box"></i>
                    </span>
                </div>
                <div class="mt-4">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center text-xs font-medium text-primary-700 hover:text-primary-900">
                        View products
                        <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-neutral-100 p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-xs font-semibold text-neutral-500 uppercase tracking-wide">Sales</p>
                        <p class="mt-2 text-3xl font-bold text-primary-800">{{ $saleCount }}</p>
                    </div>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary-100 text-primary-700">
                        <i class="fas fa-receipt"></i>
                    </span>
                </div>
                <div class="mt-4">
                    <a href="{{ route('sales.index') }}" class="inline-flex items-center text-xs font-medium text-primary-700 hover:text-primary-900">
                        View sales
                        <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-neutral-100 p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-xs font-semibold text-neutral-500 uppercase tracking-wide">Total Revenue</p>
                        <p class="mt-2 text-3xl font-bold text-primary-800">RM {{ number_format($totalRevenue, 2) }}</p>
                        <p class="mt-1 text-xs text-neutral-500">All time</p>
                    </div>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary-100 text-primary-700">
                        <i class="fas fa-chart-line"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl shadow-sm border border-neutral-100 p-6">
                <h2 class="text-sm font-semibold text-neutral-900 uppercase tracking-wide mb-4 flex items-center gap-2">
                    <i class="fas fa-bolt text-primary-600"></i>
                    Quick Actions
                </h2>
                <div class="space-y-3">
                    <a href="{{ route('shops.create') }}" class="flex items-center justify-between w-full px-4 py-3 rounded-xl border border-neutral-200 hover:border-primary-300 hover:bg-primary-50 text-sm font-medium text-neutral-800 transition">
                        <span class="flex items-center gap-3">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-primary-100 text-primary-700">
                                <i class="fas fa-shop"></i>
                            </span>
                            <span>
                                <span class="block">Create new shop</span>
                                <span class="block text-xs text-neutral-500">Set up a shop for your products.</span>
                            </span>
                        </span>
                        <i class="fas fa-chevron-right text-xs text-neutral-400"></i>
                    </a>

                    <a href="{{ route('products.create') }}" class="flex items-center justify-between w-full px-4 py-3 rounded-xl border border-neutral-200 hover:border-primary-300 hover:bg-primary-50 text-sm font-medium text-neutral-800 transition">
                        <span class="flex items-center gap-3">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-primary-100 text-primary-700">
                                <i class="fas fa-box-open"></i>
                            </span>
                            <span>
                                <span class="block">Add product</span>
                                <span class="block text-xs text-neutral-500">Add a new item to your catalog.</span>
                            </span>
                        </span>
                        <i class="fas fa-chevron-right text-xs text-neutral-400"></i>
                    </a>

                    <a href="{{ route('sales.create') }}" class="flex items-center justify-between w-full px-4 py-3 rounded-xl border border-neutral-200 hover:border-primary-300 hover:bg-primary-50 text-sm font-medium text-neutral-800 transition">
                        <span class="flex items-center gap-3">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-primary-100 text-primary-700">
                                <i class="fas fa-receipt"></i>
                            </span>
                            <span>
                                <span class="block">Record a sale</span>
                                <span class="block text-xs text-neutral-500">Track a new customer purchase.</span>
                            </span>
                        </span>
                        <i class="fas fa-chevron-right text-xs text-neutral-400"></i>
                    </a>

                    <a href="{{ route('reports.index') }}" class="flex items-center justify-between w-full px-4 py-3 rounded-xl border border-neutral-200 hover:border-primary-300 hover:bg-primary-50 text-sm font-medium text-neutral-800 transition">
                        <span class="flex items-center gap-3">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-primary-100 text-primary-700">
                                <i class="fas fa-chart-bar"></i>
                            </span>
                            <span>
                                <span class="block">View reports</span>
                                <span class="block text-xs text-neutral-500">See performance and sales summaries.</span>
                            </span>
                        </span>
                        <i class="fas fa-chevron-right text-xs text-neutral-400"></i>
                    </a>
                </div>
            </div>

            <!-- Profile Summary -->
            <div class="bg-white rounded-2xl shadow-sm border border-neutral-100 p-6">
                <h2 class="text-sm font-semibold text-neutral-900 uppercase tracking-wide mb-4 flex items-center gap-2">
                    <i class="fas fa-user-tie text-primary-600"></i>
                    Your Profile
                </h2>
                <dl class="text-sm space-y-3">
                    <div class="flex justify-between gap-4">
                        <dt class="text-neutral-500">Name</dt>
                        <dd class="font-medium text-neutral-900 truncate max-w-[60%] text-right">{{ auth('artisan')->user()->name }}</dd>
                    </div>
                    <div class="flex justify-between gap-4">
                        <dt class="text-neutral-500">Email</dt>
                        <dd class="font-medium text-neutral-900 truncate max-w-[60%] text-right">{{ auth('artisan')->user()->email }}</dd>
                    </div>
                    <div class="flex justify-between gap-4">
                        <dt class="text-neutral-500">Phone</dt>
                        <dd class="font-medium text-neutral-900 truncate max-w-[60%] text-right">{{ auth('artisan')->user()->phone }}</dd>
                    </div>
                    <div class="flex justify-between gap-4">
                        <dt class="text-neutral-500">Address</dt>
                        <dd class="font-medium text-neutral-900 text-right max-w-[60%]">
                            {{ auth('artisan')->user()->address ?? 'Not set' }}
                        </dd>
                    </div>
                    <div class="flex justify-between items-center gap-4">
                        <dt class="text-neutral-500">Status</dt>
                        <dd>
                            @if(auth('artisan')->user()->status === 'active')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-rose-100 text-rose-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-1.5"></span>
                                    Inactive
                                </span>
                            @endif
                        </dd>
                    </div>
                </dl>

                <div class="mt-6 flex justify-end">
                    <a href="{{ route('artisans.edit', auth('artisan')->user()) }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-primary-600 text-white text-sm font-medium hover:bg-primary-700 shadow-sm">
                        <i class="fas fa-edit mr-2"></i>
                        Edit profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
