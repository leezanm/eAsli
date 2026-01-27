@extends('layouts.app')

@section('title', 'Shop Details')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <!-- Back link -->
    <div class="mb-6">
        <a href="{{ route('shops.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-neutral-700 hover:text-primary-700">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Shop List</span>
        </a>
    </div>

    <!-- Shop header -->
    <div class="bg-white rounded-2xl shadow-lg border border-secondary-200 p-8 mb-10">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-neutral-900 mb-2 flex items-center gap-3">
                    <span class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 text-white">
                        <i class="fas fa-shop text-xl"></i>
                    </span>
                    <span>{{ $shop->name }}</span>
                </h1>
                @if($shop->address)
                    <p class="text-neutral-700 mb-1"><i class="fas fa-map-marker-alt text-accent-600 mr-2"></i>{{ $shop->address }}</p>
                @endif
                @if($shop->state)
                    <p class="text-neutral-700 mb-1"><i class="fas fa-flag text-primary-600 mr-2"></i>{{ $shop->state }}</p>
                @endif
                <p class="text-sm text-neutral-500">
                    <span class="font-semibold">Status:</span>
                    <span class="ml-1 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $shop->status === 'active' ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }}">
                        {{ $shop->status === 'active' ? 'Active' : 'Closed' }}
                    </span>
                </p>
                @if($shop->latitude && $shop->longitude)
                    <p class="text-xs text-neutral-500 mt-2">Coordinates: {{ number_format($shop->latitude, 4) }}, {{ number_format($shop->longitude, 4) }}</p>
                @endif
            </div>
            <div class="space-y-3">
                <div class="space-y-2 text-sm text-neutral-700">
                    @if($shop->artisan)
                        <p class="flex items-center gap-2">
                            <i class="fas fa-user text-primary-600"></i>
                            <span><span class="font-semibold">Artisan:</span> {{ $shop->artisan->name }}</span>
                        </p>
                    @endif
                    @if($shop->phone)
                        <p class="flex items-center gap-2">
                            <i class="fas fa-phone text-primary-600"></i>
                            <span>{{ $shop->phone }}</span>
                        </p>
                    @endif
                </div>
                @if($shop->latitude && $shop->longitude)
                    <a href="https://www.google.com/maps/?q={{ $shop->latitude }},{{ $shop->longitude }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center w-full gap-2 px-4 py-2 rounded-lg bg-gradient-to-r from-accent-500 to-accent-600 text-white text-sm font-semibold shadow-md hover:from-accent-600 hover:to-accent-700 transition">
                        <i class="fas fa-map"></i>
                        <span>Open on Google Maps</span>
                    </a>
                @endif
            </div>
        </div>

        @if($shop->description)
            <div class="mt-6 border-t border-neutral-200 pt-4">
                <h2 class="text-lg font-semibold text-neutral-900 mb-2">Shop Description</h2>
                <p class="text-neutral-700 leading-relaxed">{{ $shop->description }}</p>
            </div>
        @endif
    </div>

    <!-- Products list -->
    <div class="bg-secondary-50 rounded-2xl border border-secondary-200 p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-neutral-900 flex items-center gap-2">
                <i class="fas fa-boxes-stacked text-primary-600"></i>
                <span>Products in this Shop</span>
            </h2>
            <span class="text-sm text-neutral-600">Total: {{ $products->count() }}</span>
        </div>

        @if($products->isEmpty())
            <div class="text-center py-10 text-neutral-500">
                <i class="fas fa-box-open text-5xl mb-3 text-neutral-300"></i>
                <p class="font-semibold">There are no products for this shop yet.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                        <div class="bg-white rounded-xl shadow-md border border-neutral-200 overflow-hidden flex flex-col">
                            <div class="h-40 bg-gradient-to-br from-primary-100 to-secondary-100">
                                @if($product->image_path)
                                    <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-box text-4xl text-neutral-400"></i>
                                    </div>
                                @endif
                            </div>
                        <div class="p-4 flex-1 flex flex-col">
                            <h3 class="font-semibold text-neutral-900 mb-1 line-clamp-2">{{ $product->name }}</h3>
                            @if($product->price)
                                <p class="text-primary-700 font-bold mb-2">RM {{ number_format($product->price, 2) }}</p>
                            @endif
                            @if($product->description)
                                <p class="text-sm text-neutral-600 line-clamp-3 mb-3">{{ $product->description }}</p>
                            @endif
                            <div class="mt-auto flex items-center justify-between text-xs text-neutral-500">
                                <span>Stock: {{ $product->stock ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
