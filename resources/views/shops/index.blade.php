@extends('layouts.app')

@section('title', 'Shops')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <!-- Page header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-neutral-900 flex items-center gap-3">
                <span class="inline-flex items-center justify-center w-11 h-11 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 text-white shadow-lg">
                    <i class="fas fa-shop text-lg"></i>
                </span>
                <span>Shops</span>
            </h1>
            <p class="mt-2 text-neutral-600 text-sm md:text-base">Manage all artisan shops in a clean, modern view.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ Auth::guard('artisan')->check() ? route('artisans.dashboard') : route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-neutral-300 text-sm font-medium text-neutral-700 hover:bg-neutral-50 transition">
                <i class="fas fa-arrow-left"></i>
                <span>Back</span>
            </a>
            @auth('artisan')
                <a href="{{ route('shops.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gradient-to-r from-primary-600 to-primary-500 text-white text-sm font-semibold shadow-md hover:from-primary-700 hover:to-primary-600 transition">
                    <i class="fas fa-plus"></i>
                    <span>Add New Shop</span>
                </a>
            @endauth
        </div>
    </div>

    @if($shops->isEmpty())
        <!-- Empty state -->
        <div class="bg-white rounded-2xl border border-secondary-200 shadow-md py-12 px-6 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-secondary-100 text-secondary-700 mb-4">
                <i class="fas fa-inbox text-2xl"></i>
            </div>
            <h2 class="text-xl font-semibold text-neutral-900 mb-1">No shops yet</h2>
            <p class="text-neutral-600 mb-4">Start by adding a new shop to display your products.</p>
            @auth('artisan')
                <a href="{{ route('shops.create') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-lg bg-gradient-to-r from-accent-500 to-accent-600 text-white text-sm font-semibold shadow-md hover:from-accent-600 hover:to-accent-700 transition">
                    <i class="fas fa-plus"></i>
                    <span>Add Shop</span>
                </a>
            @endauth
        </div>
    @else
        <!-- Shops grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($shops as $shop)
                <div class="bg-white rounded-2xl border border-secondary-200 shadow-md hover:shadow-xl transition transform hover:-translate-y-1 flex flex-col">
                    <div class="p-6 flex-1 flex flex-col gap-3">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h2 class="text-lg font-semibold text-neutral-900 flex items-center gap-2">
                                    <i class="fas fa-store text-primary-600"></i>
                                    <span>{{ $shop->name }}</span>
                                </h2>
                                @if($shop->address ?? $shop->location)
                                    <p class="mt-1 text-sm text-neutral-600">
                                        <i class="fas fa-map-marker-alt text-accent-600 mr-1"></i>
                                        {{ $shop->address ?? $shop->location }}
                                    </p>
                                @endif
                            </div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $shop->status === 'active' ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }}">
                                {{ $shop->status === 'active' ? 'Active' : 'Closed' }}
                            </span>
                        </div>

                        <div class="mt-2 space-y-1 text-xs text-neutral-600">
                            <p>
                                <span class="font-semibold text-neutral-800">Products:</span>
                                <span class="ml-1">{{ $shop->products_count ?? ($shop->products->count() ?? 0) }}</span>
                            </p>
                            @if($shop->state)
                                <p>
                                    <span class="font-semibold text-neutral-800">State:</span>
                                    <span class="ml-1">{{ $shop->state }}</span>
                                </p>
                            @endif
                            @if($shop->latitude && $shop->longitude)
                                <p>
                                    <span class="font-semibold text-neutral-800">Coordinates:</span>
                                    <span class="ml-1">{{ number_format($shop->latitude, 4) }}, {{ number_format($shop->longitude, 4) }}</span>
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="border-t border-neutral-200 px-6 py-4 flex items-center justify-between gap-3 bg-neutral-0/60">
                        <a href="{{ route('shops.show', $shop) }}" class="inline-flex items-center gap-2 text-xs font-semibold text-primary-700 hover:text-primary-800">
                            <i class="fas fa-eye"></i>
                            <span>View</span>
                        </a>
                        @auth('artisan')
                            <div class="flex items-center gap-3">
                                <a href="{{ route('shops.edit', $shop) }}" class="inline-flex items-center gap-1 px-3 py-1 rounded-md border border-primary-300 text-xs font-semibold text-primary-700 hover:bg-primary-50">
                                    <i class="fas fa-edit"></i>
                                    <span>Edit</span>
                                </a>
                                <form method="POST" action="{{ route('shops.destroy', $shop) }}" onsubmit="return confirm('Are you sure you want to delete this shop?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 px-3 py-1 rounded-md border border-red-300 text-xs font-semibold text-red-600 hover:bg-red-50">
                                        <i class="fas fa-trash"></i>
                                        <span>Delete</span>
                                    </button>
                                </form>
                            </div>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
