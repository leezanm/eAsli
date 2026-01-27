<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'eAsli') }} - @yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Poppins', ui-sans-serif, system-ui, sans-serif;
        }
          .min-h-screen {
    min-height: 0vh;
  }
    </style>
</head>
<body class="bg-secondary-100 text-neutral-900">
    <!-- Navigation (fixed at very top) -->
    <nav class="bg-white fixed top-0 inset-x-0 z-50 border-b border-neutral-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Top Navigation Bar (Etsy-like) -->
            <div class="flex items-center justify-between h-20 gap-4">
                <!-- Logo & Categories -->
                <div class="flex items-center gap-6">
                    <!-- Logo -->
                    <a href="{{ route('home') }}" class="text-3xl font-black flex items-center gap-1 whitespace-nowrap">
                        <span class="text-accent-600 tracking-wide">eAsli</span>
                    </a>

                    <!-- Categories Dropdown -->
                    <div class="hidden lg:block relative group">
                        <button class="text-neutral-800 hover:text-neutral-900 transition font-medium text-sm flex items-center gap-2 py-2">
                            <i class="fas fa-bars text-lg"></i>
                            <span>Categories</span>
                        </button>
                        <div class="absolute left-0 mt-1 w-56 bg-white border border-neutral-200 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-150 z-50">
                            <a href="{{ route('products.shop') }}" class="block px-4 py-3 text-neutral-800 hover:bg-neutral-50 transition first:rounded-t-lg">
                                <i class="fas fa-gem mr-2 text-accent-500"></i>All Products
                            </a>
                            <a href="#" class="block px-4 py-3 text-neutral-800 hover:bg-neutral-50 transition">
                                <i class="fas fa-hand-holding-heart mr-2 text-primary-500"></i>Handmade Gifts
                            </a>
                            <a href="#" class="block px-4 py-3 text-neutral-800 hover:bg-neutral-50 transition">
                                <i class="fas fa-home mr-2 text-primary-600"></i>Home Favourites
                            </a>
                            <a href="{{ route('shops.map') }}" class="block px-4 py-3 text-neutral-800 hover:bg-neutral-50 transition last:rounded-b-lg">
                                <i class="fas fa-map-marker-alt mr-2 text-accent-600"></i>Explore Map
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Search Bar -->
                <div class="hidden md:flex flex-1 max-w-3xl mx-4">
                    <form action="{{ route('products.shop') }}" method="GET" class="w-full">
                        <div class="flex items-center w-full rounded-full border border-neutral-300 bg-white shadow-sm overflow-hidden">
                            <input
                                type="text"
                                name="search"
                                placeholder="Search for anything"
                                class="flex-1 px-5 py-3 text-sm text-neutral-800 placeholder-neutral-400 focus:outline-none"
                            >
                            <button type="submit" class="h-11 w-11 rounded-full bg-accent-600 hover:bg-accent-700 text-white flex items-center justify-center mr-1 transition">
                                <i class="fas fa-search text-lg"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Right Icons & Auth -->
                <div class="flex items-center gap-4">
                    <!-- Wishlist Icon -->
                    <a href="#" class="text-neutral-800 hover:text-neutral-900 transition relative" title="Wishlist">
                        <i class="far fa-heart text-xl"></i>
                    </a>

                    <!-- Gifts Icon -->
                    <a href="#" class="text-neutral-800 hover:text-neutral-900 transition relative" title="Gifts">
                        <i class="far fa-gift-card text-xl"></i>
                    </a>

                    <!-- Cart Icon -->
                    <a href="{{ route('cart.index') }}" class="text-neutral-800 hover:text-neutral-900 transition relative" title="Shopping Cart">
                        <i class="fas fa-shopping-bag text-xl"></i>
                    </a>

                    <!-- User Menu / Sign in -->
                    @auth('artisan')
                        <div class="relative group">
                            <button class="flex items-center gap-2 text-neutral-800 hover:text-neutral-900 transition text-sm font-medium">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-secondary-400 to-secondary-600 flex items-center justify-center text-white font-bold text-sm">
                                    {{ substr(auth('artisan')->user()->name, 0, 1) }}
                                </div>
                                <span class="hidden sm:inline">{{ auth('artisan')->user()->name }}</span>
                            </button>
                            <div class="absolute right-0 mt-1 w-52 bg-white border border-neutral-200 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-150 z-50">
                                <a href="{{ route('artisans.dashboard') }}" class="block px-4 py-3 text-neutral-800 hover:bg-neutral-50 transition first:rounded-t-lg">
                                    <i class="fas fa-chart-line mr-2"></i>Dashboard
                                </a>
                                <a href="{{ route('artisans.show', Auth::guard('artisan')->user()->id) }}" class="block px-4 py-3 text-neutral-800 hover:bg-neutral-50 transition">
                                    <i class="fas fa-user-circle mr-2"></i>Profile
                                </a>
                                <a href="{{ route('artisans.change-password') }}" class="block px-4 py-3 text-neutral-800 hover:bg-neutral-50 transition">
                                    <i class="fas fa-key mr-2"></i>Change Password
                                </a>
                                <div class="border-t border-neutral-200"></div>
                                <form action="{{ route('artisans.logout') }}" method="POST" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-3 text-red-600 hover:bg-red-50 transition last:rounded-b-lg">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endauth

                    @auth('web')
                        <div class="relative group">
                            <button class="flex items-center gap-2 text-neutral-800 hover:text-neutral-900 transition text-sm font-medium">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-secondary-500 to-secondary-700 flex items-center justify-center text-white font-bold text-sm">
                                    {{ substr(auth('web')->user()->name, 0, 1) }}
                                </div>
                                <span class="hidden sm:inline">{{ auth('web')->user()->name }}</span>
                            </button>
                            <div class="absolute right-0 mt-1 w-52 bg-white border border-neutral-200 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-150 z-50">
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 text-neutral-800 hover:bg-neutral-50 transition first:rounded-t-lg">
                                    <i class="fas fa-cog mr-2"></i>Admin Panel
                                </a>
                                {{-- <a href="#" class="block px-4 py-3 text-neutral-800 hover:bg-neutral-50 transition">
                                    <i class="fas fa-chart-bar mr-2"></i>Reports
                                </a> --}}
                                <div class="border-t border-neutral-200"></div>
                                <form action="{{ route('admin.logout') }}" method="POST" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-3 text-red-600 hover:bg-red-50 transition last:rounded-b-lg">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endauth

                    @auth('customer')
                        <div class="relative group">
                            <button class="flex items-center gap-2 text-neutral-800 hover:text-neutral-900 transition text-sm font-medium">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center text-white font-bold text-sm">
                                    {{ substr(auth('customer')->user()->name, 0, 1) }}
                                </div>
                                <span class="hidden sm:inline">{{ auth('customer')->user()->name }}</span>
                            </button>
                            <div class="absolute right-0 mt-1 w-52 bg-white border border-neutral-200 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-150 z-50">
                                <a href="{{ route('customers.show', auth('customer')->user()) }}" class="block px-4 py-3 text-neutral-800 hover:bg-neutral-50 transition first:rounded-t-lg">
                                    <i class="fas fa-receipt mr-2"></i>My Orders
                                </a>
                                <a href="{{ route('customers.history', auth('customer')->user()->id) }}" class="block px-4 py-3 text-neutral-800 hover:bg-neutral-50 transition">
                                    <i class="fas fa-history mr-2"></i>Order History
                                </a>
                                <div class="border-t border-neutral-200"></div>
                                <form action="{{ route('customers.logout') }}" method="POST" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-3 text-red-600 hover:bg-red-50 transition last:rounded-b-lg">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endauth

                    @if(auth('artisan')->guest() && auth('web')->guest() && auth('customer')->guest())
                        <div class="relative group">
                            <button class="flex items-center gap-2 text-neutral-800 hover:text-neutral-900 transition text-sm font-medium">
                                <i class="fas fa-user-circle text-xl"></i>
                                <span class="hidden sm:inline">Sign in</span>
                            </button>
                            <div class="absolute right-0 mt-1 w-56 bg-white border border-neutral-200 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-150 z-50">
                                <a href="{{ route('artisans.login') }}" class="block px-4 py-3 text-neutral-800 hover:bg-neutral-50 transition first:rounded-t-lg">
                                    <i class="fas fa-store mr-2"></i>Artisan Login
                                </a>
                                <a href="{{ route('customers.login') }}" class="block px-4 py-3 text-neutral-800 hover:bg-neutral-50 transition">
                                    <i class="fas fa-user mr-2"></i>Customer Login
                                </a>
                                <a href="{{ route('admin.login') }}" class="block px-4 py-3 text-neutral-800 hover:bg-neutral-50 transition last:rounded-b-lg">
                                    <i class="fas fa-user-shield mr-2"></i>Admin Login
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Secondary Navigation (Categories row) -->
            <div class="hidden lg:block border-t border-neutral-200">
                <div class="flex items-center justify-center gap-8 py-3 text-sm font-medium text-neutral-700 overflow-x-auto">
                    <a href="#" class="whitespace-nowrap hover:text-primary-700 transition flex items-center gap-1">
                        <i class="fas fa-gift text-xs"></i>
                        <span>Gifts</span>
                    </a>
                    <a href="#" class="whitespace-nowrap hover:text-primary-700 transition flex items-center gap-1">
                        <i class="fas fa-star text-xs"></i>
                        <span>Best of eAsli</span>
                    </a>
                    <a href="#" class="whitespace-nowrap hover:text-primary-700 transition flex items-center gap-1">
                        <i class="fas fa-home text-xs"></i>
                        <span>Home Favourites</span>
                    </a>
                    <a href="#" class="whitespace-nowrap hover:text-primary-700 transition flex items-center gap-1">
                        <i class="fas fa-tshirt text-xs"></i>
                        <span>Fashion Finds</span>
                    </a>
                    <a href="#" class="whitespace-nowrap hover:text-primary-700 transition flex items-center gap-1">
                        <i class="fas fa-bookmark text-xs"></i>
                        <span>Local Registry</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Alert Messages -->
    <div class="max-w-7xl mx-auto px-4 py-4">
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-5 mb-4 shadow-md">
                <h3 class="text-red-700 font-bold mb-3 text-lg"><i class="fas fa-exclamation-circle mr-2"></i>Ada Kesalahan!</h3>
                <ul class="text-red-600 text-sm space-y-2">
                    @foreach ($errors->all() as $error)
                        <li class="flex items-center"><i class="fas fa-times-circle mr-2"></i>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-5 mb-4 flex justify-between items-start shadow-md">
                <div>
                    <p class="text-green-700 font-semibold"><i class="fas fa-check-circle mr-2"></i>{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.style.display='none';" class="text-green-600 hover:text-green-800 text-xl">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif
    </div>

    <!-- Page Content (offset for fixed navbar height) -->
    <main class="min-h-screen pt-24 lg:pt-28">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-primary-800 to-primary-700 text-neutral-100 mt-5 border-t-4 border-accent-400 shadow-xl">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-10">
                <div class="hover:translate-y-[-4px] transition">
                    <h3 class="text-white font-bold mb-4 text-lg flex items-center gap-2">
                        <i class="fas fa-leaf text-accent-400 text-2xl"></i>eAsli
                    </h3>
                    <p class="text-sm leading-relaxed text-neutral-300">A digital platform that helps local artisans manage shops, products, and sales more efficiently and professionally.</p>
                    <div class="flex gap-4 mt-4">
                        <a href="#" class="text-accent-400 hover:text-white transition text-lg"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-accent-400 hover:text-white transition text-lg"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-accent-400 hover:text-white transition text-lg"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4 text-lg">Quick Navigation</h4>
                    <ul class="text-sm space-y-3">
                        <li><a href="{{ route('home') }}" class="text-neutral-300 hover:text-accent-400 transition flex items-center gap-2"><i class="fas fa-chevron-right text-accent-500"></i>Home</a></li>
                        <li><a href="{{ route('shops.map') }}" class="text-neutral-300 hover:text-accent-400 transition flex items-center gap-2"><i class="fas fa-chevron-right text-accent-500"></i>Explore Shops</a></li>
                        <li><a href="{{ route('products.shop') }}" class="text-neutral-300 hover:text-accent-400 transition flex items-center gap-2"><i class="fas fa-chevron-right text-accent-500"></i>Product Catalogue</a></li>
                        <li><a href="{{ route('artisans.login') }}" class="text-neutral-300 hover:text-accent-400 transition flex items-center gap-2"><i class="fas fa-chevron-right text-accent-500"></i>Artisan Login</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-4 text-lg">Contact Us</h4>
                    <ul class="text-sm space-y-3 text-neutral-300">
                        <li class="flex items-center gap-3"><i class="fas fa-envelope text-accent-400 w-5"></i>
                            <a href="mailto:info@easli.com" class="hover:text-accent-400 transition">info@easli.com</a>
                        </li>
                        <li class="flex items-center gap-3"><i class="fas fa-phone text-accent-400 w-5"></i>
                            <span>+60-3-xxxx-xxxx</span>
                        </li>
                        <li class="flex items-center gap-3"><i class="fas fa-map-marker-alt text-accent-400 w-5"></i>
                            <span>Kuala Lumpur, Malaysia</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-primary-700 pt-8">
                <p class="text-center text-sm text-neutral-400">&copy; 2026 eAsli Platform. All rights reserved. | Built with <span class="text-red-400">❤</span> for local artisans in Malaysia.</p>
            </div>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />
    @yield('js')
</body>
</html>
