@extends('layouts.app')

@section('title', 'Shop Details')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <!-- Back link -->
    <div class="mb-6">
        <a href="{{ route('shops.index') }}" id="backLink" class="inline-flex items-center gap-2 text-sm font-medium text-neutral-700 hover:text-primary-700">
            <i class="fas fa-arrow-left"></i>
            <span id="backText">Back to Shop List</span>
        </a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const backLink = document.getElementById('backLink');
            const backText = document.getElementById('backText');
            const referrer = document.referrer;

            // Check if referrer contains 'home' or '/' (home page)
            if (referrer.includes('localhost:8000/') || referrer.includes('/')) {
                const referrerPath = new URL(referrer).pathname;

                if (referrerPath === '/' || referrerPath.endsWith('welcome')) {
                    // Came from home page
                    backLink.href = "{{ route('home') }}";
                    backText.textContent = 'Back to Home';
                } else {
                    // Default to shops list
                    backLink.href = "{{ route('shops.index') }}";
                    backText.textContent = 'Back to Shop List';
                }
            }
        });
    </script>

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
            <div class="space-y-3">
                <!-- Header Row -->
                <div class="hidden md:grid grid-cols-12 gap-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white p-4 rounded-lg font-semibold">
                    <div class="col-span-1 text-center">Image</div>
                    <div class="col-span-3">Product Name</div>
                    <div class="col-span-3">Description</div>
                    <div class="col-span-1 text-center">Price</div>
                    <div class="col-span-1 text-center">Stock</div>
                    <div class="col-span-2 text-center">Action</div>
                </div>

                <!-- Products -->
                @foreach($products as $product)
                    <div class="bg-white rounded-lg border border-neutral-200 p-4 hover:shadow-md transition">
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 md:items-center">
                            <!-- Product Image -->
                            <div class="md:col-span-1">
                                <div class="h-20 bg-gradient-to-br from-primary-100 to-secondary-100 rounded-lg overflow-hidden flex-shrink-0">
                                    @if($product->image_path)
                                        <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <i class="fas fa-box text-2xl text-neutral-400"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Product Name -->
                            <div class="md:col-span-3">
                                <p class="md:hidden text-xs text-neutral-600 font-semibold mb-1">PRODUCT</p>
                                <h3 class="font-semibold text-neutral-900">{{ $product->name }}</h3>
                            </div>

                            <!-- Product Description -->
                            <div class="md:col-span-3">
                                <p class="md:hidden text-xs text-neutral-600 font-semibold mb-1">DESCRIPTION</p>
                                <p class="text-sm text-neutral-600 line-clamp-2">{{ $product->description ?? '-' }}</p>
                            </div>

                            <!-- Price -->
                            <div class="md:col-span-1">
                                <p class="md:hidden text-xs text-neutral-600 font-semibold mb-1">PRICE</p>
                                @if($product->price)
                                    <p class="text-lg font-bold text-primary-700">RM {{ number_format($product->price, 2) }}</p>
                                @else
                                    <p class="text-neutral-500">-</p>
                                @endif
                            </div>

                            <!-- Stock -->
                            <div class="md:col-span-1">
                                <p class="md:hidden text-xs text-neutral-600 font-semibold mb-1">STOCK</p>
                                <div class="flex items-center justify-center gap-1">
                                    <i class="fas fa-cubes text-sm"></i>
                                    <span class="font-semibold {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">{{ $product->stock ?? 0 }}</span>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div class="md:col-span-2">
                                <p class="md:hidden text-xs text-neutral-600 font-semibold mb-2">ACTION</p>
                                @if(auth('artisan')->check() || auth('web')->check())
                                    <!-- Artisan/Admin: Edit button -->
                                    <a href="{{ route('products.edit', $product) }}?shop_id={{ $shop->id }}" class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 rounded-lg bg-gradient-to-r from-yellow-500 to-yellow-600 text-white text-xs md:text-sm font-semibold shadow-md hover:from-yellow-600 hover:to-yellow-700 transition">
                                        <i class="fas fa-edit"></i>
                                        <span>Edit</span>
                                    </a>
                                @else
                                    <!-- Customer/Guest: Add to cart button -->
                                    {{-- @if(auth('customer')->check()) --}}
                                        @if($product->stock > 0)
                                            <form method="POST" action="{{ route('cart.add', $product) }}" class="w-full">
                                                @csrf
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 rounded-lg bg-gradient-to-r from-primary-600 to-primary-500 text-white text-xs md:text-sm font-semibold shadow-md hover:from-primary-700 hover:to-primary-600 transition">
                                                    <i class="fas fa-shopping-cart"></i>
                                                    <span>Add</span>
                                                </button>
                                            </form>
                                        @else
                                            <button disabled class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 rounded-lg bg-neutral-300 text-neutral-600 text-xs md:text-sm font-semibold cursor-not-allowed">
                                                <i class="fas fa-ban"></i>
                                                <span>Out</span>
                                            </button>
                                        @endif
                                    {{-- @else
                                        <a href="{{ route('customers.login') }}" class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 rounded-lg bg-gradient-to-r from-accent-500 to-accent-600 text-white text-xs md:text-sm font-semibold shadow-md hover:from-accent-600 hover:to-accent-700 transition">
                                            <i class="fas fa-sign-in-alt"></i>
                                            <span>Login</span>
                                        </a>
                                    @endif --}}
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
