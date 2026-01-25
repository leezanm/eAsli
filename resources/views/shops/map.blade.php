@extends('layouts.app')

@section('title', 'Shop Map')

@section('content')
<div class="bg-gradient-to-br from-neutral-100 to-neutral-50 min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-primary-800 flex items-center gap-3">
                    <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-primary-100 text-primary-700">
                        <i class="fas fa-map"></i>
                    </span>
                    <span>Shop Map</span>
                </h1>
                <p class="mt-2 text-neutral-600 text-sm md:text-base">
                    Explore active shops on the map and find artisans near you.
                </p>
            </div>
            <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 rounded-lg border border-neutral-300 text-neutral-700 hover:bg-neutral-100 text-sm font-medium">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Home
            </a>
        </div>

        <!-- Search + Map -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Search panel -->
            <div class="bg-white rounded-2xl shadow-md border border-neutral-200 p-6 flex flex-col gap-4">
                <h2 class="text-sm font-semibold text-neutral-900 uppercase tracking-wide flex items-center gap-2">
                    <i class="fas fa-location-crosshairs text-primary-600"></i>
                    <span>Find Nearby Shops</span>
                </h2>
                <p class="text-xs text-neutral-600">Use your current location or enter coordinates to search within a radius and filter by state, category, or product name.</p>

                <div class="space-y-4">
                    <div>
                        <label for="latitude" class="block text-xs font-semibold text-neutral-700 uppercase mb-1">Latitude</label>
                        <input type="number" id="latitude" step="0.0001" placeholder="e.g. 3.1357"
                               class="w-full px-3 py-2 rounded-lg border border-neutral-300 text-sm focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-200">
                    </div>
                    <div>
                        <label for="longitude" class="block text-xs font-semibold text-neutral-700 uppercase mb-1">Longitude</label>
                        <input type="number" id="longitude" step="0.0001" placeholder="e.g. 101.6689"
                               class="w-full px-3 py-2 rounded-lg border border-neutral-300 text-sm focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-200">
                    </div>
                    <div>
                        <label for="radius" class="block text-xs font-semibold text-neutral-700 uppercase mb-1">Radius (km)</label>
                        <input type="number" id="radius" value="5" min="1"
                               class="w-full px-3 py-2 rounded-lg border border-neutral-300 text-sm focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-200">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-2">
                    <div>
                        <label for="state" class="block text-xs font-semibold text-neutral-700 uppercase mb-1">State (Negeri)</label>
                        <select id="state" class="w-full px-3 py-2 rounded-lg border border-neutral-300 text-sm bg-white focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-200">
                            <option value="">All States</option>
                            @isset($states)
                                @foreach($states as $state)
                                    <option value="{{ $state }}">{{ $state }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                    <div>
                        <label for="category" class="block text-xs font-semibold text-neutral-700 uppercase mb-1">Category</label>
                        <select id="category" class="w-full px-3 py-2 rounded-lg border border-neutral-300 text-sm bg-white focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-200">
                            <option value="">All Categories</option>
                            @isset($categories)
                                @foreach($categories as $category)
                                    <option value="{{ $category }}">{{ $category }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                </div>

                <div class="mt-3">
                    <label for="product_name" class="block text-xs font-semibold text-neutral-700 uppercase mb-1">Product Name</label>
                    <input type="text" id="product_name" placeholder="e.g. Batik scarf"
                           class="w-full px-3 py-2 rounded-lg border border-neutral-300 text-sm focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-200">
                </div>

                <div class="flex flex-col sm:flex-row gap-3 mt-2">
                    <button id="searchBtn" type="button" class="flex-1 inline-flex items-center justify-center px-4 py-2 rounded-lg bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold shadow">
                        <i class="fas fa-search mr-2"></i>
                        Search Nearby
                    </button>
                    <button id="getCurrentLocation" type="button" class="flex-1 inline-flex items-center justify-center px-4 py-2 rounded-lg bg-neutral-100 hover:bg-neutral-200 text-neutral-800 text-sm font-semibold border border-neutral-300">
                        <i class="fas fa-location-arrow mr-2"></i>
                        Use Current Location
                    </button>
                </div>
            </div>

            <!-- Map -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-md border border-neutral-200 overflow-hidden">
                <div id="map" class="w-full h-[480px]"></div>
            </div>
        </div>

        <!-- Shop list -->
        <div id="shopList" class="bg-white rounded-2xl shadow-md border border-neutral-200 p-6">
            <!-- Shop list will be populated here -->
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    const map = L.map('map').setView([3.1357, 101.6689], 12);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(map);

    let userMarker = null;
    let shopMarkers = [];

    @php
        $allShops = $shops->map(function ($shop) {
            return [
                'id' => $shop->id,
                'name' => $shop->name,
                'address' => $shop->address,
                'latitude' => $shop->latitude,
                'longitude' => $shop->longitude,
                'products_count' => optional($shop->artisan)->products->count() ?? 0,
                'products' => $shop->artisan
                    ? $shop->artisan->products->map(function ($product) {
                        return [
                            'id' => $product->id,
                            'name' => $product->name,
                            'price' => $product->price,
                        ];
                    })->values()->all()
                    : [],
            ];
        });
    @endphp

    const allShops = @json($allShops);

    function clearShopMarkers() {
        shopMarkers.forEach(marker => map.removeLayer(marker));
        shopMarkers = [];
    }

    function renderShopsOnMap(shops) {
        clearShopMarkers();

        shops.forEach(shop => {
            if (!shop.latitude || !shop.longitude) return;

            const products = Array.isArray(shop.products) ? shop.products : [];
            let productsHtml = '';

            if (products.length > 0) {
                const limited = products.slice(0, 3);
                productsHtml = '<ul class="mt-2 text-xs text-neutral-700">' +
                    limited.map(p => `
                        <li class="flex items-center justify-between gap-2">
                            <span class="truncate">${p.name}</span>
                            <span class="font-semibold text-primary-700">RM ${Number(p.price).toFixed(2)}</span>
                        </li>
                    `).join('') +
                    '</ul>';

                if (products.length > 3) {
                    productsHtml += `<p class="mt-1 text-[11px] text-neutral-500">+${products.length - 3} more products</p>`;
                }
            } else {
                productsHtml = '<p class="mt-2 text-xs text-neutral-500">No products registered yet.</p>';
            }

            const popupHtml = `
                <div class="text-left">
                    <h3 class="text-sm font-semibold text-neutral-900 mb-1">${shop.name}</h3>
                    <p class="text-xs text-neutral-600 mb-1">${shop.address ?? ''}</p>
                    <p class="text-[11px] text-neutral-500 mb-1">Products: ${shop.products_count ?? 0}</p>
                    ${productsHtml}
                    <a href="/shops/${shop.id}" class="inline-flex items-center mt-2 px-3 py-1.5 rounded-lg border border-primary-200 text-[11px] font-semibold text-primary-700 bg-white hover:bg-primary-50">
                        <i class="fas fa-arrow-right mr-1"></i>
                        View Shop
                    </a>
                </div>
            `;

            const marker = L.marker([shop.latitude, shop.longitude]).addTo(map)
                .bindPopup(popupHtml, { maxWidth: 260 });
            shopMarkers.push(marker);
        });
    }

    function renderShopList(shops, title) {
        let html = `
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-sm font-semibold text-neutral-900 uppercase tracking-wide flex items-center gap-2">
                    <i class="fas fa-store text-primary-600"></i>
                    <span>${title} (${shops.length})</span>
                </h2>
            </div>
        `;

        if (shops.length === 0) {
            html += `
                <div class="py-10 text-center text-neutral-500 text-sm">
                    <i class="fas fa-info-circle mb-2 text-neutral-400"></i>
                    <p>No shops found for this area.</p>
                </div>
            `;
        } else {
            html += '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">';
            shops.forEach(shop => {
                html += `
                    <div class="border border-neutral-200 rounded-xl p-4 bg-neutral-0 shadow-sm hover:shadow-md transition">
                        <h3 class="text-sm font-semibold text-neutral-900 mb-1">${shop.name}</h3>
                        <p class="text-xs text-neutral-600 mb-2 flex gap-2">
                            <i class="fas fa-map-marker-alt text-primary-500 mt-0.5"></i>
                            <span>${shop.address ?? ''}</span>
                        </p>
                        <p class="text-xs text-neutral-500 mb-3">Products: ${shop.products_count ?? 0}</p>
                        <a href="/shops/${shop.id}" class="inline-flex items-center px-3 py-1.5 rounded-lg border border-primary-200 text-xs font-semibold text-primary-700 hover:bg-primary-50">
                            <i class="fas fa-arrow-right mr-1"></i>
                            View Shop
                        </a>
                    </div>
                `;
            });
            html += '</div>';
        }

        document.getElementById('shopList').innerHTML = html;
    }

    document.getElementById('getCurrentLocation').addEventListener('click', function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                document.getElementById('latitude').value = lat.toFixed(4);
                document.getElementById('longitude').value = lng.toFixed(4);

                if (userMarker) map.removeLayer(userMarker);
                userMarker = L.circleMarker([lat, lng], {
                    radius: 8,
                    fillColor: '#4285F4',
                    color: '#fff',
                    weight: 2,
                    opacity: 1,
                    fillOpacity: 0.8
                }).addTo(map);

                map.setView([lat, lng], 14);
            });
        }
    });

    document.getElementById('searchBtn').addEventListener('click', function() {
        const lat = parseFloat(document.getElementById('latitude').value);
        const lng = parseFloat(document.getElementById('longitude').value);
        const radius = parseFloat(document.getElementById('radius').value);
        const state = document.getElementById('state').value;
        const category = document.getElementById('category').value;
        const productName = document.getElementById('product_name').value;
        const hasCoords = !isNaN(lat) && !isNaN(lng);

        if (hasCoords) {
            const params = new URLSearchParams({
                latitude: lat,
                longitude: lng,
                radius: radius,
            });

            if (state) {
                params.append('state', state);
            }

            if (category) {
                params.append('category', category);
            }

            if (productName) {
                params.append('product_name', productName);
            }

            fetch(`{{ route('shops.nearby') }}?${params.toString()}`)
                .then(response => response.json())
                .then(data => {
                    map.setView([lat, lng], 13);

                    if (userMarker) map.removeLayer(userMarker);
                    userMarker = L.circleMarker([lat, lng], {
                        radius: 8,
                        fillColor: '#4285F4',
                        color: '#fff',
                        weight: 2,
                        opacity: 1,
                        fillOpacity: 0.8
                    }).addTo(map);

                    renderShopsOnMap(data);
                    renderShopList(data, 'Nearby Shops');
                });
        } else {
            const params = new URLSearchParams();

            if (state) {
                params.append('state', state);
            }

            if (category) {
                params.append('category', category);
            }

            if (productName) {
                params.append('product_name', productName);
            }

            if (!state && !category && !productName) {
                alert('Please select at least one filter (state, category, or product name).');
                return;
            }

            fetch(`{{ route('shops.filter') }}?${params.toString()}`)
                .then(response => response.json())
                .then(data => {
                    renderShopsOnMap(data);
                    renderShopList(data, 'Filtered Shops');
                });
        }
    });

    // Load all active shops on page load
    renderShopsOnMap(allShops);
    renderShopList(allShops, 'All Active Shops');
</script>
@endsection
