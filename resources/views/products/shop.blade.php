@extends('layouts.app')

@section('title', 'Shop All Products')

@section('content')
<div class="bg-gradient-to-br from-secondary-50 via-secondary-100 to-neutral-0 min-h-screen py-10 relative overflow-hidden">
    <div class="absolute inset-0 opacity-3 pointer-events-none">
        <div class="absolute top-0 right-0 w-96 h-96 bg-accent-400 rounded-full mix-blend-multiply filter blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary-400 rounded-full mix-blend-multiply filter blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-secondary-400 rounded-full mix-blend-multiply filter blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <!-- Page header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-12">
            <div>
                <span class="inline-block bg-yellow-400 text-white px-4 py-2 rounded-full font-bold text-sm mb-4">
                    <i class="fas fa-star mr-2"></i>Shop Now
                </span>
                <h1 class="text-5xl md:text-6xl font-bold bg-gradient-to-r from-primary-700 via-accent-600 to-secondary-600 bg-clip-text text-transparent mb-4">
                    All Products
                </h1>
                <p class="text-neutral-700 text-lg max-w-2xl">Discover all handcrafted products from our talented artisans across Malaysia</p>
                <div class="h-1 w-32 bg-gradient-to-r from-primary-600 via-accent-600 to-secondary-600 rounded-full mt-4"></div>
            </div>
            <div class="flex flex-col gap-3">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-neutral-300 text-sm font-medium text-neutral-700 hover:bg-neutral-50 transition">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Home</span>
                </a>
            </div>
        </div>

        <!-- Search & Filter -->
        <div class="bg-white rounded-2xl shadow-md border border-secondary-200 mb-8 p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                <div>
                    <label for="searchInput" class="block text-xs font-semibold text-neutral-700 uppercase tracking-wider mb-2">Search</label>
                    <input type="text" id="searchInput" class="w-full rounded-lg border border-neutral-300 px-3 py-2 text-sm focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-200" placeholder="Search products...">
                </div>
                <div>
                    <label for="categoryFilter" class="block text-xs font-semibold text-neutral-700 uppercase tracking-wider mb-2">Category</label>
                    <select id="categoryFilter" class="w-full rounded-lg border border-neutral-300 px-3 py-2 text-sm focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-200">
                        <option value="">All Categories</option>
                        <option value="electronics">Electronics</option>
                        <option value="clothing">Clothing</option>
                        <option value="food">Food</option>
                        <option value="crafts">Crafts</option>
                        <option value="furniture">Furniture</option>
                    </select>
                </div>
                <div class="flex gap-3 md:justify-end">
                    <button type="button" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-gradient-to-r from-accent-500 to-accent-600 text-white text-sm font-semibold shadow-md hover:from-accent-600 hover:to-accent-700 w-full md:w-auto" onclick="filterProducts()">
                        <i class="fas fa-filter"></i>
                        <span>Filter</span>
                    </button>
                </div>
            </div>
        </div>

        @if($products->isEmpty())
            <div class="bg-white rounded-2xl border border-secondary-200 shadow-md py-16 px-6 text-center">
                <i class="fas fa-box-open text-7xl text-neutral-300 mb-4 opacity-50"></i>
                <h2 class="text-2xl font-bold text-neutral-900 mb-2">No products available</h2>
                <p class="text-neutral-600 mb-6 text-lg">There are currently no products to display.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($products as $product)
                    <div class="bg-gradient-to-br from-neutral-0 to-neutral-50 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group hover:translate-y-[-12px] border-t-4 border-primary-400 relative hover:border-primary-500">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-bl from-secondary-100 to-transparent opacity-0 group-hover:opacity-100 transition-opacity z-20"></div>

                        <div class="relative h-64 bg-gradient-to-br from-neutral-200 to-neutral-300 overflow-hidden">
                            @if($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500 brightness-100 group-hover:brightness-110">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary-100 to-secondary-100">
                                    <i class="fas fa-box text-neutral-400 text-6xl"></i>
                                </div>
                            @endif

                            <div class="absolute top-4 right-4 transform group-hover:scale-110 transition-transform">
                                @if($product->stock > 0)
                                    <span class="bg-gradient-to-r from-primary-600 to-primary-700 text-white px-4 py-2 rounded-full text-xs font-bold uppercase shadow-lg flex items-center gap-1">
                                        <i class="fas fa-check-circle"></i>In Stock
                                    </span>
                                @else
                                    <span class="bg-gradient-to-r from-red-600 to-red-700 text-white px-4 py-2 rounded-full text-xs font-bold uppercase shadow-lg flex items-center gap-1">
                                        <i class="fas fa-times-circle"></i>Out of Stock
                                    </span>
                                @endif
                            </div>

                            @if($product->stock <= 5 && $product->stock > 0)
                                <div class="absolute bottom-4 left-4">
                                    <span class="bg-gradient-to-r from-amber-500 to-amber-600 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg flex items-center gap-1">
                                        <i class="fas fa-exclamation"></i>Low Stock
                                    </span>
                                </div>
                            @endif
                        </div>

                        <div class="p-6 relative z-10">
                            <div class="mb-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-primary-50 text-primary-700">
                                    {{ ucfirst($product->category) }}
                                </span>
                            </div>

                            <h3 class="text-lg font-bold text-neutral-900 mb-3 line-clamp-2 group-hover:text-accent-700 transition">{{ $product->name }}</h3>

                            @if($product->artisan)
                                <div class="mb-4 p-3 bg-gradient-to-r from-primary-50 to-secondary-50 rounded-lg border-l-4 border-primary-500">
                                    <p class="text-sm text-primary-800 flex items-center gap-2 font-semibold">
                                        <i class="fas fa-user-circle text-primary-600 text-base"></i>
                                        {{ $product->artisan->name }}
                                    </p>
                                </div>
                            @endif

                            @if($product->description)
                                <p class="text-sm text-neutral-600 line-clamp-2 mb-3">{{ $product->description }}</p>
                            @endif

                            <div class="border-t-2 border-neutral-200 my-4"></div>

                            <div class="space-y-3">
                                <div>
                                    <p class="text-xs text-neutral-600 uppercase tracking-wider mb-1 font-bold">Price</p>
                                    <p class="text-2xl font-bold bg-gradient-to-r from-accent-500 to-accent-700 bg-clip-text text-transparent">RM {{ number_format($product->price, 2) }}</p>
                                </div>
                                <p class="text-sm text-neutral-600">
                                    <span class="font-semibold">Stock:</span>
                                    <span class="ml-1">{{ $product->stock }} units</span>
                                </p>
                                <div class="flex items-center gap-2 pt-2">
                                    <a href="{{ route('products.show', $product) }}" class="flex-1 bg-gradient-to-br from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-bold py-2 px-4 rounded-xl transition shadow-lg hover:shadow-2xl flex items-center justify-center text-sm gap-1">
                                        <i class="fas fa-eye"></i>
                                        <span>View</span>
                                    </a>
                                    @if(!auth('artisan')->check() && !auth('web')->check())
                                        <form method="POST" action="{{ route('cart.add', $product) }}" class="flex-1">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-accent-700 bg-accent-50 rounded-xl hover:bg-accent-100 transition shadow-sm gap-1">
                                                <i class="fas fa-cart-plus"></i>
                                                <span>Add</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<script>
function filterProducts() {
    const search = document.getElementById('searchInput').value;
    const category = document.getElementById('categoryFilter').value;
    window.location.href = `{{ route('products.shop') }}?search=${encodeURIComponent(search)}&category=${encodeURIComponent(category)}`;
}

document.getElementById('searchInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') filterProducts();
});
</script>
@endsection
