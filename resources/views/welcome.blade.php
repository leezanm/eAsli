@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

<!-- Interactive Map Section -->
<section class="bg-white py-24 px-5 relative ">


    <div class="absolute inset-0 opacity-3">

        <div class="absolute top-0 left-1/4 w-96 h-96 bg-primary-200 rounded-full mix-blend-multiply filter blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-accent-200 rounded-full mix-blend-multiply filter blur-3xl"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 relative z-10">
         <!-- Main Heading -->
                <div class="text-center mb-12 mt-12">

                <!-- Description -->
                <p class="text-xl md:text-xl text-neutral-700 leading-relaxed font-medium">
                    Explore unique handcrafted products from talented artisans across Malaysia. Support the local economy and discover premium quality items.
                </p>
                 </div>
        <!-- Section Header -->
        <div class="text-center mb-12">
            <span class="inline-block bg-primary-500 text-white px-4 py-2 rounded-full font-bold text-sm mb-4">
                <i class="fas fa-map mr-2"></i>Interactive Map
            </span>
             <h1 class="text-xl md:text-2xl lg:text-3xl font-black leading-tight mb-6">
                        <span class="block text-neutral-800">Support</span>
                        <span class="block bg-gradient-to-r from-primary-500 via-accent-500 to-secondary-600 bg-clip-text text-transparent">Local Artisans</span>
                        <span class="block text-neutral-800">Worldwide</span>
                    </h1>
            {{-- <h2 class="text-5xl font-bold bg-gradient-to-r from-primary-600 to-accent-600 bg-clip-text text-transparent mb-4">Find Nearby Shops</h2> --}}
            <p class="text-neutral-700 text-lg max-w-2xl mx-auto font-medium">Hover or click on markers to see complete information about artisans and their products</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8" style="height: 600px;">
            <!-- Map Container -->
            <div class="lg:col-span-3" style="height: 100%; border-radius: 24px; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1); border: 2px solid #d1d5db;">
                <div id="map" style="width: 100%; height: 100%; background: #f0f0f0;"></div>
            </div>

            <!-- Sidebar Info Panel -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col hover:shadow-3xl transition-all duration-300 border-2 border-secondary-200">
                <div class="bg-gradient-to-br from-primary-600 via-primary-500 to-accent-500 text-white p-6">
                    <h2 class="text-2xl font-bold flex items-center gap-2">
                        <i class="fas fa-store text-secondary-200 text-3xl"></i>Shop Info
                    </h2>
                    <p class="text-sm text-primary-100 mt-2">Select a marker on the map for details</p>
                </div>

                <div id="shopInfo" class="p-6 flex-1 overflow-y-auto">
                    <div class="text-center text-neutral-400 py-12">
                        <i class="fas fa-map-pin text-6xl mb-4 opacity-20 text-primary-500"></i>
                        <p class="font-semibold text-neutral-700">Select a shop on the map</p>
                        <p class="text-sm text-neutral-500 mt-2">to see complete information</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section with Sage Frame + White Content Card -->
{{-- <div class="bg-gradient-to-b from-primary-700 via-primary-600 to-primary-500 text-neutral-800 py-24 relative overflow-hidden min-h-screen flex items-center">
    <!-- Animated background elements -->
    <div class="absolute inset-0">
        <!-- Blob 1 -->
        <div class="absolute top-0 left-10 w-72 h-72 bg-primary-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
        <!-- Blob 2 -->
        <div class="absolute top-20 right-10 w-72 h-72 bg-secondary-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse" style="animation-delay: 1s;"></div>
        <!-- Blob 3 -->
        <div class="absolute -bottom-10 left-1/2 w-72 h-72 bg-accent-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse" style="animation-delay: 2s;"></div>
        <!-- Blob 4 -->
        <div class="absolute top-1/2 right-1/4 w-96 h-96 bg-primary-50 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse" style="animation-delay: 0.5s;"></div>
    </div>

    <!-- Decorative shapes -->
    <div class="absolute top-10 left-5 opacity-15">
        <svg width="100" height="100" viewBox="0 0 100 100" fill="none">
            <circle cx="50" cy="50" r="45" stroke="currentColor" stroke-width="2"/>
            <path d="M50 20 L80 80 L20 80 Z" stroke="currentColor" stroke-width="2" fill="none"/>
        </svg>
    </div>
    <div class="absolute bottom-10 right-5 opacity-15">
        <svg width="150" height="150" viewBox="0 0 150 150" fill="none">
            <rect x="20" y="20" width="110" height="110" stroke="currentColor" stroke-width="2" rx="20"/>
            <circle cx="75" cy="75" r="30" stroke="currentColor" stroke-width="2" fill="none"/>
        </svg>
    </div>

    <div class="max-w-6xl mx-auto px-8 py-10 relative z-10 w-full bg-white/95 rounded-3xl shadow-2xl border border-secondary-200">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div class="space-y-8">
                <!-- Animated Badge -->
                <div class="inline-block">
                    <span class="inline-flex items-center gap-2 bg-gradient-to-r from-accent-600 to-accent-500 text-white px-6 py-3 rounded-full font-bold text-sm shadow-lg backdrop-blur-sm border border-accent-500 animate-pulse">
                        <span class="flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-accent-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-white"></span>
                        </span>
                        eAsli Exclusive Platform
                    </span>
                </div>

                <!-- Main Heading -->
                <div>
                    <h1 class="text-6xl md:text-7xl lg:text-8xl font-black leading-tight mb-6">
                        <span class="block text-neutral-800">Support</span>
                        <span class="block bg-gradient-to-r from-primary-500 via-accent-500 to-secondary-600 bg-clip-text text-transparent">Local Artisans</span>
                        <span class="block text-neutral-800">Worldwide</span>
                    </h1>
                    <div class="h-2 w-32 bg-gradient-to-r from-primary-400 to-accent-500 rounded-full"></div>
                </div>

                <!-- Description -->
                <p class="text-xl md:text-2xl text-neutral-700 leading-relaxed max-w-lg font-medium">
                    Explore unique handcrafted products from talented artisans across Malaysia. Support the local economy and discover premium quality items.
                </p>

                <!-- Feature Pills -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="flex items-center gap-3 bg-gradient-to-br from-secondary-100 to-secondary-50 backdrop-blur-sm p-4 rounded-lg border-2 border-secondary-300 hover:bg-secondary-50 transition shadow-lg hover:shadow-xl hover:scale-105 transform">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 shadow-lg">
                                <i class="fas fa-shopping-bag text-white text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <p class="font-bold text-lg text-neutral-800">{{ \App\Models\Product::count() }}</p>
                            <p class="text-sm text-neutral-600">Premium Products</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 bg-gradient-to-br from-secondary-100 to-secondary-50 backdrop-blur-sm p-4 rounded-lg border-2 border-secondary-300 hover:bg-secondary-50 transition shadow-lg hover:shadow-xl hover:scale-105 transform">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-gradient-to-br from-primary-400 to-primary-500 shadow-lg">
                                <i class="fas fa-users text-white text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <p class="font-bold text-lg text-neutral-800">{{ \App\Models\Artisan::count() }}</p>
                            <p class="text-sm text-neutral-600">Active Artisans</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 bg-gradient-to-br from-secondary-100 to-secondary-50 backdrop-blur-sm p-4 rounded-lg border-2 border-secondary-300 hover:bg-secondary-50 transition shadow-lg hover:shadow-xl hover:scale-105 transform">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-gradient-to-br from-accent-500 to-accent-600 shadow-lg">
                                <i class="fas fa-map-marker-alt text-white text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <p class="font-bold text-lg text-neutral-800">{{ \App\Models\Shop::count() }}</p>
                            <p class="text-sm text-neutral-600">Verified Shops</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 bg-gradient-to-br from-secondary-100 to-secondary-50 backdrop-blur-sm p-4 rounded-lg border-2 border-secondary-300 hover:bg-secondary-50 transition shadow-lg hover:shadow-xl hover:scale-105 transform">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-gradient-to-br from-accent-400 to-accent-500 shadow-lg">
                                <i class="fas fa-check-circle text-white text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <p class="font-bold text-lg text-neutral-800">{{ \App\Models\Sale::count() }}</p>
                            <p class="text-sm text-neutral-600">Successful Orders</p>
                        </div>
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="{{ route('artisans.login') }}" class="group relative inline-flex items-center justify-center gap-2 px-8 py-4 font-bold text-lg rounded-xl overflow-hidden shadow-2xl transform hover:scale-105 transition-all duration-300">
                        <div class="absolute inset-0 bg-gradient-to-r from-primary-600 to-primary-500 opacity-100 group-hover:opacity-90 transition"></div>
                        <div class="relative flex items-center gap-2 text-white">
                            <i class="fas fa-sign-in-alt text-xl group-hover:animate-bounce"></i>
                            <span>Artisan Login</span>
                        </div>
                    </a>
                    <a href="{{ route('artisans.create') }}" class="group relative inline-flex items-center justify-center gap-2 px-8 py-4 font-bold text-lg rounded-xl border-2 border-accent-600 text-accent-700 hover:bg-accent-600 hover:text-white transition-all duration-300 shadow-lg">
                        <i class="fas fa-rocket text-xl group-hover:animate-bounce"></i>
                        <span>Register Now</span>
                    </a>
                </div>
            </div>

            <!-- Right Visual -->
            <div class="hidden lg:block relative h-[600px]">
                <!-- Floating Cards Animation -->
                <div class="absolute top-0 right-0 w-64 h-80 bg-gradient-to-br from-primary-500 to-primary-600 rounded-3xl shadow-2xl transform -rotate-6 hover:rotate-0 transition-transform duration-300 hover:shadow-3xl hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-500/90 to-primary-600/90 rounded-3xl"></div>
                    <div class="flex flex-col items-center justify-center h-full text-white p-6">
                        <i class="fas fa-leaf text-7xl mb-4 text-secondary-200 drop-shadow-2xl font-bold"></i>
                        <p class="text-2xl font-bold text-center drop-shadow-lg text-white">Local Products</p>
                        <p class="text-sm mt-2 text-center text-primary-100 drop-shadow-md font-semibold">Premium Quality</p>
                    </div>
                </div>
                <div class="absolute top-32 left-0 w-64 h-80 bg-gradient-to-br from-accent-500 to-accent-600 rounded-3xl shadow-2xl transform rotate-6 hover:rotate-0 transition-transform duration-300 delay-100 hover:shadow-3xl hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-br from-accent-500/90 to-accent-600/90 rounded-3xl"></div>
                    <div class="flex flex-col items-center justify-center h-full text-white p-6">
                        <i class="fas fa-hammer text-7xl mb-4 text-secondary-200 drop-shadow-2xl font-bold"></i>
                        <p class="text-2xl font-bold text-center drop-shadow-lg text-white">Expert Artisans</p>
                        <p class="text-sm mt-2 text-center text-accent-100 drop-shadow-md font-semibold">Decades of Experience</p>
                    </div>
                </div>
                <div class="absolute bottom-0 right-32 w-64 h-80 bg-gradient-to-br from-primary-400 to-primary-500 rounded-3xl shadow-2xl transform rotate-3 hover:rotate-0 transition-transform duration-300 delay-200 hover:shadow-3xl hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-400/90 to-primary-500/90 rounded-3xl"></div>
                    <div class="flex flex-col items-center justify-center h-full text-white p-6">
                        <i class="fas fa-star text-7xl mb-4 text-secondary-200 drop-shadow-2xl font-bold"></i>
                        <p class="text-2xl font-bold text-center drop-shadow-lg text-white">Trusted</p>
                        <p class="text-sm mt-2 text-center text-primary-100 drop-shadow-md font-semibold">Highly Rated by Customers</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- Stats Section -->
<section class="bg-secondary-50 py-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-3">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-primary-300 rounded-full mix-blend-multiply filter blur-3xl"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-accent-300 rounded-full mix-blend-multiply filter blur-3xl"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="text-center mb-16">
            <span class="inline-block bg-accent-500 text-white px-4 py-2 rounded-full font-bold text-sm mb-4">
                <i class="fas fa-chart-bar mr-2"></i>Real-time Stats
            </span>
            <h2 class="text-5xl font-bold text-neutral-800 mb-4">Our Platform is Growing Fast</h2>
            <p class="text-neutral-700 text-lg max-w-2xl mx-auto">Join thousands of local artisans who trust eAsli</p>
            <div class="h-1 w-32 bg-gradient-to-r from-primary-600 via-accent-600 to-secondary-600 rounded-full mx-auto mt-6"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-8 text-center border-l-4 border-primary-400 hover:translate-y-[-8px] transform hover:scale-105">
                <div class="bg-gradient-to-br from-primary-500 to-primary-600 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 shadow-lg transform hover:scale-110 transition">
                    <i class="fas fa-users text-white text-2xl"></i>
                </div>
                <p class="text-neutral-800 text-sm font-semibold uppercase mb-2 tracking-wider text-primary-700">Total Artisans</p>
                <p class="text-5xl font-bold text-primary-600">{{ \App\Models\Artisan::count() }}</p>
                <p class="text-neutral-600 text-xs mt-3 flex items-center justify-center gap-1">
                    <i class="fas fa-arrow-up text-primary-500"></i>Active Artisans
                </p>
            </div>
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-8 text-center border-l-4 border-accent-400 hover:translate-y-[-8px] transform hover:scale-105">
                <div class="bg-gradient-to-br from-accent-500 to-accent-600 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 shadow-lg transform hover:scale-110 transition">
                    <i class="fas fa-shop text-white text-2xl"></i>
                </div>
                <p class="text-neutral-800 text-sm font-semibold uppercase mb-2 tracking-wider text-accent-700">Total Shops</p>
                <p class="text-5xl font-bold text-accent-600">{{ \App\Models\Shop::count() }}</p>
                <p class="text-neutral-600 text-xs mt-3 flex items-center justify-center gap-1">
                    <i class="fas fa-arrow-up text-accent-500"></i>Verified Shops
                </p>
            </div>
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-8 text-center border-l-4 border-primary-300 hover:translate-y-[-8px] transform hover:scale-105">
                <div class="bg-gradient-to-br from-primary-400 to-primary-500 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 shadow-lg transform hover:scale-110 transition">
                    <i class="fas fa-box text-white text-2xl"></i>
                </div>
                <p class="text-neutral-800 text-sm font-semibold uppercase mb-2 tracking-wider text-primary-600">Total Products</p>
                <p class="text-5xl font-bold text-primary-500">{{ \App\Models\Product::count() }}</p>
                <p class="text-neutral-600 text-xs mt-3 flex items-center justify-center gap-1">
                    <i class="fas fa-arrow-up text-primary-400"></i>Available Products
                </p>
            </div>
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-8 text-center border-l-4 border-accent-300 hover:translate-y-[-8px] transform hover:scale-105">
                <div class="bg-gradient-to-br from-accent-400 to-accent-500 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 shadow-lg transform hover:scale-110 transition">
                    <i class="fas fa-receipt text-white text-2xl"></i>
                </div>
                <p class="text-neutral-800 text-sm font-semibold uppercase mb-2 tracking-wider text-accent-600">Total Sales</p>
                <p class="text-5xl font-bold text-accent-500">{{ \App\Models\Sale::count() }}</p>
                <p class="text-neutral-600 text-xs mt-3 flex items-center justify-center gap-1">
                    <i class="fas fa-arrow-up text-accent-400"></i>Successful Orders
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="bg-white py-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-3">
        <div class="absolute top-0 right-0 w-96 h-96 bg-accent-200 rounded-full mix-blend-multiply filter blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary-200 rounded-full mix-blend-multiply filter blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-secondary-200 rounded-full mix-blend-multiply filter blur-3xl"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="flex flex-col md:flex-row justify-between items-center mb-16">
            <div>
                <span class="inline-block bg-accent-500 text-white px-4 py-2 rounded-full font-bold text-sm mb-4">
                    <i class="fas fa-star mr-2"></i>Best Picks
                </span>
                <h2 class="text-5xl font-bold bg-gradient-to-r from-primary-700 via-accent-600 to-secondary-600 bg-clip-text text-transparent mb-4">Featured Products</h2>
                <div class="h-1 w-32 bg-gradient-to-r from-primary-600 via-accent-600 to-secondary-600 rounded-full"></div>
            </div>
            <a href="{{ route('products.index') }}" class="mt-6 md:mt-0 bg-gradient-to-r from-accent-500 to-accent-600 hover:from-accent-600 hover:to-accent-700 text-white font-bold py-3 px-8 rounded-lg transition shadow-lg hover:shadow-2xl transform hover:scale-105 flex items-center gap-2">
                View All Products <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse(\App\Models\Product::with('artisan')->limit(8)->get() as $product)
            <div class="bg-gradient-to-br from-neutral-0 to-neutral-50 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group hover:translate-y-[-12px] border-t-4 border-primary-400 relative hover:border-primary-500">
                <!-- Decorative corners -->
                <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-bl from-secondary-100 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>

                <!-- Product Image -->
                <div class="relative h-64 bg-gradient-to-br from-neutral-200 to-neutral-300 overflow-hidden">
                    @if($product->image_path)
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500 brightness-100 group-hover:brightness-110">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary-100 to-secondary-100">
                            <i class="fas fa-box text-neutral-400 text-6xl"></i>
                        </div>
                    @endif

                    <!-- Stock Badge -->
                    <div class="absolute top-4 right-4 transform group-hover:scale-110 transition-transform">
                        <span class="bg-gradient-to-r from-primary-600 to-primary-700 text-white px-4 py-2 rounded-full text-xs font-bold uppercase shadow-lg flex items-center gap-1">
                            <i class="fas fa-check-circle"></i>In Stock
                        </span>
                    </div>

                    <!-- Rating Badge -->
                    <div class="absolute bottom-4 left-4">
                        <span class="bg-gradient-to-r from-accent-500 to-yellow-400 text-primary-900 px-3 py-1 rounded-full text-xs font-bold shadow-lg flex items-center gap-1">
                            <i class="fas fa-star"></i>4.8/5
                        </span>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="p-6 relative z-10">
                    <!-- Product Name -->
                    <h3 class="text-lg font-bold text-neutral-900 mb-3 line-clamp-2 group-hover:text-accent-700 transition">{{ $product->name }}</h3>

                    <!-- Artisan Info -->
                    @if($product->artisan)
                    <div class="mb-4 p-3 bg-gradient-to-r from-primary-50 to-secondary-50 rounded-lg border-l-4 border-primary-500">
                        <p class="text-sm text-primary-800 flex items-center gap-2 mb-2 font-semibold">
                            <i class="fas fa-user-circle text-primary-600 text-base"></i>
                            {{ $product->artisan->name }}
                        </p>
                        @php
                            $shop = $product->artisan->shops()->first();
                        @endphp
                        @if($shop)
                        <p class="text-xs text-secondary-700 flex items-center gap-2">
                            <i class="fas fa-map-pin text-secondary-600"></i>
                            {{ $shop->address ?? 'Lokasi tidak tersedia' }}
                        </p>
                        @endif
                    </div>
                    @endif

                    <!-- Divider with gradient -->
                    <div class="border-t-2 border-gradient-to-r from-transparent via-neutral-300 to-transparent my-4"></div>

                    <!-- Price & Button -->
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-neutral-600 uppercase tracking-wider mb-1 font-bold">Price</p>
                            <p class="text-3xl font-bold bg-gradient-to-r from-accent-500 to-accent-700 bg-clip-text text-transparent">RM {{ number_format($product->price, 2) }}</p>
                        </div>
                        <a href="{{ route('products.show', $product->id) }}" class="bg-gradient-to-br from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-bold py-3 px-4 rounded-xl transition shadow-lg hover:shadow-2xl flex items-center justify-center h-16 w-16 transform hover:scale-125 hover:rotate-12 duration-300">
                            <i class="fas fa-eye text-lg"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-16">
                <i class="fas fa-box-open text-7xl text-neutral-300 mb-4 opacity-50"></i>
                <p class="text-neutral-600 text-lg font-semibold">No products available yet</p>
                <p class="text-neutral-500 text-sm mt-2">Products will be available soon</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Shop Our Most-Loved Categories Section -->
<section class="bg-gradient-to-b from-neutral-0 to-primary-50 py-20 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <!-- Section Header -->
        <div class="mb-16">
            <h2 class="text-4xl md:text-5xl font-black text-primary-900 mb-2">Shop our most-loved categories</h2>
            <p class="text-neutral-600 text-lg">Discover the artisan products our customers love most</p>
        </div>

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-6">
            <!-- Category 1 -->
            <a href="#" class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 h-64 flex flex-col justify-end">
                <div class="absolute inset-0 bg-gradient-to-br from-primary-200 to-primary-400 group-hover:scale-110 transition-transform duration-300"></div>
                <div class="flex items-center justify-center h-full text-6xl opacity-80 group-hover:opacity-100 transition-opacity z-10">
                    <i class="fas fa-palette"></i>
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <h3 class="relative text-white font-bold text-lg p-4 z-20">Handmade Crafts</h3>
            </a>

            <!-- Category 2 -->
            <a href="#" class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 h-64 flex flex-col justify-end">
                <div class="absolute inset-0 bg-gradient-to-br from-accent-200 to-accent-400 group-hover:scale-110 transition-transform duration-300"></div>
                <div class="flex items-center justify-center h-full text-6xl opacity-80 group-hover:opacity-100 transition-opacity z-10">
                    <i class="fas fa-ring"></i>
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <h3 class="relative text-white font-bold text-lg p-4 z-20">Jewelry</h3>
            </a>

            <!-- Category 3 -->
            <a href="#" class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 h-64 flex flex-col justify-end">
                <div class="absolute inset-0 bg-gradient-to-br from-secondary-200 to-secondary-400 group-hover:scale-110 transition-transform duration-300"></div>
                <div class="flex items-center justify-center h-full text-6xl opacity-80 group-hover:opacity-100 transition-opacity z-10">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <h3 class="relative text-white font-bold text-lg p-4 z-20">Home Decor</h3>
            </a>

            <!-- Category 4 -->
            <a href="#" class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 h-64 flex flex-col justify-end">
                <div class="absolute inset-0 bg-gradient-to-br from-pink-200 to-pink-400 group-hover:scale-110 transition-transform duration-300"></div>
                <div class="flex items-center justify-center h-full text-6xl opacity-80 group-hover:opacity-100 transition-opacity z-10">
                    <i class="fas fa-shirt"></i>
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <h3 class="relative text-white font-bold text-lg p-4 z-20">Fashion</h3>
            </a>

            <!-- Category 5 -->
            <a href="#" class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 h-64 flex flex-col justify-end">
                <div class="absolute inset-0 bg-gradient-to-br from-yellow-200 to-yellow-400 group-hover:scale-110 transition-transform duration-300"></div>
                <div class="flex items-center justify-center h-full text-6xl opacity-80 group-hover:opacity-100 transition-opacity z-10">
                    <i class="fas fa-images"></i>
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <h3 class="relative text-white font-bold text-lg p-4 z-20">Art & Design</h3>
            </a>

            <!-- Category 6 -->
            <a href="#" class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 h-64 flex flex-col justify-end">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-200 to-purple-400 group-hover:scale-110 transition-transform duration-300"></div>
                <div class="flex items-center justify-center h-full text-6xl opacity-80 group-hover:opacity-100 transition-opacity z-10">
                    <i class="fas fa-gift"></i>
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <h3 class="relative text-white font-bold text-lg p-4 z-20">Gift Ideas</h3>
            </a>
        </div>
    </div>
</section>
<!-- Call to Action Hero Section -->
<section class="bg-gradient-to-br from-primary-300 via-accent-200 to-secondary-300 text-primary-900 py-24 relative overflow-hidden">
    <!-- Animated background elements -->
    <div class="absolute inset-0 opacity-15">
        <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full mix-blend-multiply filter blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-accent-400 rounded-full mix-blend-multiply filter blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-primary-400 rounded-full mix-blend-multiply filter blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
    </div>

    <!-- Decorative lines -->
    <div class="absolute top-10 left-10 text-primary-600 opacity-30 text-6xl">
        <i class="fas fa-leaf animate-pulse"></i>
    </div>
    <div class="absolute bottom-10 right-10 text-primary-600 opacity-30 text-6xl" style="animation-delay: 0.5s;">
        <i class="fas fa-leaf animate-pulse" style="transform: rotate(180deg);"></i>
    </div>

    <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
        <!-- Badge -->
        <div class="inline-block bg-white bg-opacity-40 text-primary-800 px-6 py-3 rounded-full font-bold text-sm mb-6 backdrop-blur-sm border-2 border-primary-600 hover:bg-opacity-60 transition">
            <i class="fas fa-rocket mr-2"></i>Join the eAsli Community
        </div>

        <!-- Main Heading -->
        <h2 class="text-6xl md:text-7xl font-bold mb-6 leading-tight">
            <span class="inline-block bg-gradient-to-r from-primary-700 via-secondary-700 to-primary-700 bg-clip-text text-transparent">Start Managing Your Business</span>
        </h2>

        <!-- Subheading -->
        <p class="text-xl md:text-2xl mb-12 text-primary-800 font-medium max-w-2xl mx-auto leading-relaxed">
            Register as an artisan or login to access all <span class="font-bold text-secondary-700">eAsli</span> features for free. Increase your product visibility now!
        </p>

        <!-- Stats line before buttons -->
        <div class="flex justify-center gap-8 mb-12 text-sm flex-wrap">
            <div class="flex items-center gap-2 hover:scale-110 transition">
                <i class="fas fa-check-circle text-primary-700 text-xl"></i>
                <span class="text-primary-900 font-semibold">100% Free</span>
            </div>
            <div class="flex items-center gap-2 hover:scale-110 transition">
                <i class="fas fa-check-circle text-secondary-700 text-xl"></i>
                <span class="text-primary-900 font-semibold">Easy Setup</span>
            </div>
            <div class="flex items-center gap-2 hover:scale-110 transition">
                <i class="fas fa-check-circle text-accent-600 text-xl"></i>
                <span class="text-primary-900 font-semibold">24/7 Support</span>
            </div>
        </div>

        <!-- CTA Buttons -->
        <div class="flex gap-6 justify-center flex-wrap">
            <a href="{{ route('artisans.login') }}" class="group bg-white text-primary-700 hover:bg-neutral-100 font-bold py-4 px-12 rounded-xl transition shadow-2xl hover:shadow-3xl transform hover:scale-110 flex items-center gap-3 border-2 border-primary-600">
                <i class="fas fa-sign-in-alt group-hover:animate-bounce text-xl"></i>
                <span>Artisan Login</span>
            </a>
            <a href="{{ route('artisans.create') }}" class="group bg-gradient-to-r from-accent-400 to-yellow-300 hover:from-accent-500 hover:to-yellow-400 text-primary-900 font-bold py-4 px-12 rounded-xl transition shadow-2xl hover:shadow-3xl transform hover:scale-110 flex items-center gap-3">
                <i class="fas fa-user-plus group-hover:animate-bounce text-xl"></i>
                <span>Register New</span>
            </a>
        </div>

        <!-- Bottom ornament -->
        <div class="mt-12 flex justify-center gap-2 text-primary-700 text-opacity-60">
            <i class="fas fa-sparkles"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-sparkles"></i>
        </div>
    </div>
</section>



<script>
    function initializeMap() {
        const mapElement = document.getElementById('map');
        if (!mapElement) {
            console.error('Map element not found');
            return;
        }

        if (typeof L === 'undefined') {
            console.error('Leaflet library not available');
            return;
        }

        try {
            // Create map with basic options
            const map = L.map('map').setView([4.2105, 101.6964], 6);

            // Add tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 19
            }).addTo(map);

            console.log('Map initialized successfully');

            // Fetch shops and add markers
            const shops = @json(\App\Models\Shop::with('artisan.products')->get());

            if (shops && shops.length > 0) {
                shops.forEach(shop => {
                    if (shop.latitude && shop.longitude) {
                        const marker = L.marker([shop.latitude, shop.longitude]).addTo(map);

                        marker.on('click', function() {
                            showShopInfo(shop);
                        });
                    }
                });
                console.log('Added ' + shops.length + ' shop markers');
            } else {
                console.log('No shops found to display');
            }

            // Function to display shop info
            function showShopInfo(shop) {
                const shopInfo = document.getElementById('shopInfo');
                const products = shop.artisan ? shop.artisan.products : [];
                const productsHtml = products.map(p =>
                    `<div class="flex items-center justify-between py-3 px-3 border-b border-neutral-200 hover:bg-neutral-50 rounded transition">
                        <span class="text-sm font-medium text-neutral-800">${p.name}</span>
                        <span class="text-xs font-bold text-accent-600 bg-accent-50 px-2 py-1 rounded">RM ${p.price}</span>
                    </div>`
                ).join('');

                shopInfo.innerHTML = `
                    <div class="space-y-5">
                        <div class="bg-gradient-to-br from-primary-50 to-primary-100 p-5 rounded-xl border-l-4 border-primary-600 shadow-md">
                            <h3 class="text-lg font-bold text-primary-800 mb-3 flex items-center gap-2">
                                <i class="fas fa-store text-primary-600"></i>${shop.name}
                            </h3>
                            <p class="text-sm text-neutral-700 mb-2 flex items-center gap-2">
                                <i class="fas fa-map-pin text-primary-600 w-4"></i>${shop.location}
                            </p>
                            <p class="text-sm text-neutral-700 mb-2 flex items-center gap-2">
                                <i class="fas fa-user text-primary-600 w-4"></i>
                                <strong>${shop.artisan.name}</strong>
                            </p>
                            <p class="text-sm text-neutral-700 flex items-center gap-2">
                                <i class="fas fa-phone text-primary-600 w-4"></i>${shop.phone || 'Not available'}
                            </p>
                        </div>

                        <div>
                            <h4 class="font-bold text-neutral-800 mb-3 flex items-center gap-2 text-base">
                                <i class="fas fa-box text-accent-600"></i>Products (${products.length})
                            </h4>
                            <div class="space-y-1 bg-neutral-50 rounded-xl p-3">
                                ${productsHtml || '<p class="text-sm text-neutral-500 py-4 text-center">No products registered</p>'}
                            </div>
                        </div>

                        <a href="{{ url('shops') }}/${shop.id}" class="block w-full bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-bold py-3 px-4 rounded-lg text-center transition shadow-lg hover:shadow-xl">
                            <i class="fas fa-external-link-alt mr-2"></i>View Shop Details
                        </a>
                    </div>
                `;
            }

        } catch (error) {
            console.error('Error initializing map:', error);
        }
    }

    // Call the function when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeMap);
    } else {
        initializeMap();
    }
</script>
