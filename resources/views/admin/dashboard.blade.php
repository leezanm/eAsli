@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="bg-gradient-to-br from-neutral-100 to-neutral-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Header Section -->
        <div class="mb-10">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 bg-neutral-0 rounded-2xl shadow-lg p-8 border-l-8 border-primary-600">
                <div>
                    <h1 class="text-5xl font-bold text-primary-800 flex items-center gap-4 mb-3">
                        <i class="fas fa-chart-line text-white bg-primary-700 p-4 rounded-full w-16 h-16 flex items-center justify-center"></i>
                        Admin Dashboard
                    </h1>
                    <p class="text-lg text-neutral-700"><i class="fas fa-user-circle text-primary-600 mr-2"></i>Welcome, <span class="font-bold text-primary-700">{{ auth('web')->user()->name }}</span></p>
                </div>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="bg-secondary-600 hover:bg-secondary-700 text-white font-bold py-3 px-8 rounded-lg transition transform hover:scale-105 shadow-lg">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-8 p-5 bg-green-50 border-l-4 border-green-500 rounded-lg text-green-700 flex items-start animate-pulse">
                <i class="fas fa-check-circle text-green-600 mt-1 mr-4 text-lg"></i>
                <span class="font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <!-- Artisans Card -->
            <div class="bg-neutral-0 rounded-xl shadow-md hover:shadow-xl transition p-8 border-l-4 border-primary-600 group">
                <div class="flex justify-between items-start mb-4">
                    <div class="bg-primary-100 p-4 rounded-full group-hover:bg-primary-200 transition">
                        <i class="fas fa-users text-primary-700 text-2xl"></i>
                    </div>
                    <i class="fas fa-arrow-up text-primary-600 opacity-0 group-hover:opacity-100 transition"></i>
                </div>
                <p class="text-neutral-800 text-sm font-bold uppercase tracking-wider mb-2">Total Artisans</p>
                <p class="text-4xl font-bold text-primary-800">{{ \App\Models\Artisan::count() }}</p>
                <p class="text-xs text-neutral-600 mt-4"><i class="fas fa-info-circle mr-1"></i>Active artisans</p>
            </div>

            <!-- Shops Card -->
            <div class="bg-neutral-0 rounded-xl shadow-md hover:shadow-xl transition p-8 border-l-4 border-secondary-600 group">
                <div class="flex justify-between items-start mb-4">
                    <div class="bg-secondary-100 p-4 rounded-full group-hover:bg-secondary-200 transition">
                        <i class="fas fa-store text-secondary-700 text-2xl"></i>
                    </div>
                    <i class="fas fa-arrow-up text-secondary-600 opacity-0 group-hover:opacity-100 transition"></i>
                </div>
                <p class="text-neutral-800 text-sm font-bold uppercase tracking-wider mb-2">Total Shops</p>
                <p class="text-4xl font-bold text-secondary-800">{{ \App\Models\Shop::count() }}</p>
                <p class="text-xs text-neutral-600 mt-4"><i class="fas fa-info-circle mr-1"></i>Registered shops</p>
            </div>

            <!-- Products Card -->
            <div class="bg-neutral-0 rounded-xl shadow-md hover:shadow-xl transition p-8 border-l-4 border-accent-500 group">
                <div class="flex justify-between items-start mb-4">
                    <div class="bg-accent-100 p-4 rounded-full group-hover:bg-accent-200 transition">
                        <i class="fas fa-box text-accent-700 text-2xl"></i>
                    </div>
                    <i class="fas fa-arrow-up text-accent-500 opacity-0 group-hover:opacity-100 transition"></i>
                </div>
                <p class="text-neutral-800 text-sm font-bold uppercase tracking-wider mb-2">Total Products</p>
                <p class="text-4xl font-bold text-accent-800">{{ \App\Models\Product::count() }}</p>
                <p class="text-xs text-neutral-600 mt-4"><i class="fas fa-info-circle mr-1"></i>Active products</p>
            </div>

            <!-- Sales Card -->
            <div class="bg-neutral-0 rounded-xl shadow-md hover:shadow-xl transition p-8 border-l-4 border-primary-500 group">
                <div class="flex justify-between items-start mb-4">
                    <div class="bg-primary-100 p-4 rounded-full group-hover:bg-primary-200 transition">
                        <i class="fas fa-receipt text-primary-700 text-2xl"></i>
                    </div>
                    <i class="fas fa-arrow-up text-secondary-500 opacity-0 group-hover:opacity-100 transition"></i>
                </div>
                <p class="text-neutral-700 text-sm font-bold uppercase tracking-wider mb-2">Total Sales</p>
                <p class="text-4xl font-bold text-secondary-900">{{ \App\Models\Sale::count() }}</p>
                <p class="text-xs text-neutral-600 mt-4"><i class="fas fa-info-circle mr-1"></i>Transactions</p>
            </div>
        </div>

        <!-- Management Menu Grid -->
        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                <i class="fas fa-sliders-h text-primary-600"></i>Manage System
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Manage Artisans -->
                <a href="{{ route('artisans.index') }}" class="bg-white rounded-xl shadow-md hover:shadow-xl transition p-8 border-t-4 border-primary-600 group hover:scale-105 transform duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="bg-primary-100 p-4 rounded-lg group-hover:bg-primary-200 transition">
                            <i class="fas fa-users-gear text-primary-700 text-2xl"></i>
                        </div>
                        <i class="fas fa-arrow-right text-primary-600 ml-auto opacity-0 group-hover:opacity-100 transition text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Manage Artisans</h3>
                    <p class="text-gray-600 text-sm">Manage artisan profiles, personal details, and business information</p>
                </a>

                <!-- Manage Shops -->
                <a href="{{ route('shops.index') }}" class="bg-white rounded-xl shadow-md hover:shadow-xl transition p-8 border-t-4 border-secondary-600 group hover:scale-105 transform duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="bg-secondary-100 p-4 rounded-lg group-hover:bg-secondary-200 transition">
                            <i class="fas fa-store text-secondary-700 text-2xl"></i>
                        </div>
                        <i class="fas fa-arrow-right text-secondary-600 ml-auto opacity-0 group-hover:opacity-100 transition text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Manage Shops</h3>
                    <p class="text-gray-600 text-sm">Manage shop locations, addresses, and shop information</p>
                </a>

                <!-- Manage Products -->
                <a href="{{ route('products.index') }}" class="bg-white rounded-xl shadow-md hover:shadow-xl transition p-8 border-t-4 border-primary-500 group hover:scale-105 transform duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="bg-primary-100 p-4 rounded-lg group-hover:bg-primary-200 transition">
                            <i class="fas fa-box-open text-primary-700 text-2xl"></i>
                        </div>
                        <i class="fas fa-arrow-right text-primary-500 ml-auto opacity-0 group-hover:opacity-100 transition text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Manage Products</h3>
                    <p class="text-gray-600 text-sm">Manage product catalog, stock levels, and pricing</p>
                </a>

                <!-- Manage Customers -->
                <a href="{{ route('customers.index') }}" class="bg-white rounded-xl shadow-md hover:shadow-xl transition p-8 border-t-4 border-secondary-500 group hover:scale-105 transform duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="bg-secondary-100 p-4 rounded-lg group-hover:bg-secondary-200 transition">
                            <i class="fas fa-user-friends text-secondary-700 text-2xl"></i>
                        </div>
                        <i class="fas fa-arrow-right text-secondary-600 ml-auto opacity-0 group-hover:opacity-100 transition text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Manage Customers</h3>
                    <p class="text-gray-600 text-sm">Manage customer data and purchase history</p>
                </a>

                <!-- Manage Sales -->
                <a href="{{ route('sales.index') }}" class="bg-white rounded-xl shadow-md hover:shadow-xl transition p-8 border-t-4 border-primary-600 group hover:scale-105 transform duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="bg-primary-100 p-4 rounded-lg group-hover:bg-primary-200 transition">
                            <i class="fas fa-receipt text-primary-700 text-2xl"></i>
                        </div>
                        <i class="fas fa-arrow-right text-primary-600 ml-auto opacity-0 group-hover:opacity-100 transition text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Manage Sales</h3>
                    <p class="text-gray-600 text-sm">Monitor sales transactions and payments</p>
                </a>

                <!-- View Reports -->
                <a href="{{ route('reports.index') }}" class="bg-white rounded-xl shadow-md hover:shadow-xl transition p-8 border-t-4 border-secondary-600 group hover:scale-105 transform duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="bg-secondary-100 p-4 rounded-lg group-hover:bg-secondary-200 transition">
                            <i class="fas fa-chart-line text-secondary-700 text-2xl"></i>
                        </div>
                        <i class="fas fa-arrow-right text-secondary-600 ml-auto opacity-0 group-hover:opacity-100 transition text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">View Reports</h3>
                    <p class="text-gray-600 text-sm">Business analytics and sales statistics</p>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
