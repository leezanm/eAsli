@extends('layouts.app')

@section('title', 'Artisan Details')

@section('content')
<div class="bg-gradient-to-br from-neutral-100 to-neutral-50 min-h-screen py-10">
    <div class="max-w-5xl mx-auto px-4">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-primary-800 flex items-center gap-3">
                    <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-primary-100 text-primary-700">
                        <i class="fas fa-user-tie"></i>
                    </span>
                    Artisan Details
                </h1>
                <p class="mt-2 text-neutral-600">
                    Full profile and status information for this artisan.
                </p>
            </div>
            <div class="flex flex-wrap gap-3">
                @if(Auth::guard('artisan')->check())
                    <a href="{{ route('artisans.dashboard') }}" class="inline-flex items-center px-4 py-2 rounded-lg border border-neutral-300 text-neutral-700 hover:bg-neutral-100 text-sm font-medium">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Dashboard
                    </a>
                @else
                    <a href="{{ route('artisans.index') }}" class="inline-flex items-center px-4 py-2 rounded-lg border border-neutral-300 text-neutral-700 hover:bg-neutral-100 text-sm font-medium">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Artisans
                    </a>
                @endif
                <a href="{{ route('artisans.edit', $artisan) }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-primary-600 hover:bg-primary-700 text-yellow-100 text-sm font-semibold shadow">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Artisan
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 rounded-lg border-l-4 border-emerald-500 bg-emerald-50 text-emerald-800 flex items-start">
                <i class="fas fa-check-circle mt-1 mr-3"></i>
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Main card -->
        <div class="bg-white rounded-2xl shadow-sm border border-neutral-100 overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-3">
                <!-- Left: Summary -->
                <div class="md:col-span-1 border-b md:border-b-0 md:border-r border-neutral-100 bg-neutral-50 p-6 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-primary-100 text-primary-700 text-xl">
                                <i class="fas fa-user"></i>
                            </span>
                            <div>
                                <p class="text-xs font-semibold tracking-wide text-neutral-500 uppercase">Artisan Name</p>
                                <p class="text-lg font-bold text-neutral-900">{{ $artisan->name }}</p>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm text-neutral-700">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-envelope text-primary-500"></i>
                                <span>{{ $artisan->email }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-phone text-primary-500"></i>
                                <span>{{ $artisan->phone }}</span>
                            </div>
                            @if ($artisan->address)
                                <div class="flex items-start gap-2">
                                    <i class="fas fa-map-marker-alt text-primary-500 mt-0.5"></i>
                                    <span>{{ $artisan->address }}</span>
                                </div>
                            @endif
                            <div class="flex items-center gap-2">
                                <i class="fas fa-calendar-alt text-primary-500"></i>
                                <span>Joined on {{ $artisan->created_at?->format('d M Y') }}</span>
                                </div>
                            </div>
                    </div>

                    <div class="mt-6">
                        @php
                            $status = $artisan->status ?? 'inactive';
                            $statusLabel = $status === 'active' ? 'Active' : 'Pending approval';
                        @endphp
                        <p class="text-xs font-semibold tracking-wide text-neutral-500 uppercase mb-2">Status</p>
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold
                            {{ $status === 'active' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-amber-50 text-amber-700 border border-amber-100' }}">
                            <span class="w-1.5 h-1.5 rounded-full mr-1.5 {{ $status === 'active' ? 'bg-emerald-500' : 'bg-neutral-400' }}"></span>
                            {{ $statusLabel }}
                        </span>
                    </div>
                </div>

                <!-- Right: Details -->
                <div class="md:col-span-2 p-6 md:p-8 space-y-6">
                    <div>
                        <h2 class="text-lg font-semibold text-neutral-900 mb-3 flex items-center gap-2">
                            <i class="fas fa-info-circle text-primary-500"></i>
                            Artisan Description
                        </h2>
                        <p class="text-sm text-neutral-700 leading-relaxed">
                            {{ $artisan->description ?? 'No description has been provided for this artisan yet.' }}
                        </p>
                    </div>

                    <div class="border-t border-neutral-200 pt-5">
                        <h3 class="text-sm font-semibold text-neutral-900 mb-3 mt-3 uppercase tracking-wide flex items-center gap-2">
                            <i class="fas fa-database text-primary-500"></i>
                            Summary Data
                        </h3>
                        @php
                            $totalSalesCount = $artisan->sales()->count();
                            $totalSalesAmount = $artisan->sales()->sum('total_price');
                        @endphp
                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 text-sm">
                            <div class="bg-neutral-50 rounded-xl p-4 flex items-center justify-between">
                                <div>
                                    <p class="text-xs font-semibold text-neutral-500 uppercase tracking-wide">Shops</p>
                                    <p class="mt-1 text-xl font-bold text-primary-800">{{ $artisan->shops()->count() }}</p>
                                </div>
                                <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-primary-100 text-primary-600">
                                    <i class="fas fa-store"></i>
                                </span>
                            </div>
                            <div class="bg-neutral-50 rounded-xl p-4 flex items-center justify-between">
                                <div>
                                    <p class="text-xs font-semibold text-neutral-500 uppercase tracking-wide">Products</p>
                                    <p class="mt-1 text-xl font-bold text-primary-800">{{ $artisan->products()->count() }}</p>
                                </div>
                                <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-primary-100 text-primary-600">
                                    <i class="fas fa-box"></i>
                                </span>
                            </div>
                            <div class="bg-neutral-50 rounded-xl p-4 flex items-center justify-between">
                                <div>
                                    <p class="text-xs font-semibold text-neutral-500 uppercase tracking-wide">Sales</p>
                                    <p class="mt-1 text-xl font-bold text-primary-800">{{ $totalSalesCount }}</p>
                                </div>
                                <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-primary-100 text-primary-600">
                                    <i class="fas fa-receipt"></i>
                                </span>
                            </div>
                            <div class="bg-neutral-50 rounded-xl p-4 flex items-center justify-between">
                                <div>
                                    <p class="text-xs font-semibold text-neutral-500 uppercase tracking-wide">Total Sales Amount</p>
                                    <p class="mt-1 text-xl font-bold text-primary-800">RM {{ number_format($totalSalesAmount, 2) }}</p>
                                </div>
                                <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-primary-100 text-primary-600">
                                    <i class="fas fa-coins"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-neutral-200 pt-5 flex flex-wrap gap-3 justify-between items-center">
                        <p class="text-xs text-neutral-500">Last updated: {{ $artisan->updated_at?->format('d M Y, H:i') }}</p>
                        <form action="{{ route('artisans.destroy', $artisan) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this artisan? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 mt-2 rounded-lg border border-red-200 text-red-700 bg-red-50 hover:bg-red-100 text-sm font-semibold">
                                <i class="fas fa-trash mr-2"></i>
                                Delete Artisan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
