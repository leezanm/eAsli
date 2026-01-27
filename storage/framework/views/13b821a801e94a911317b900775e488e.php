<?php $__env->startSection('title', 'Home Page'); ?>

<?php $__env->startSection('content'); ?>
<!-- Interactive Map Section (same behavior as dedicated map page) -->
<section class="bg-gradient-to-br mt-5 from-neutral-100 to-neutral-50 py-16 relative overflow-hidden">
    

   <div class="max-w-7xl mt-5 mx-auto px-4 py-10">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-primary-800 flex items-center gap-3">
                    <span class="inline-flex items-center justify-center w-11 h-11 rounded-full bg-primary-100 text-primary-700">
                        <i class="fas fa-map"></i>
                    </span>
                    <span>Explore Shops Nearby You</span>
                </h2>
                <p class="mt-2 text-neutral-600 text-sm md:text-base max-w-xl">
                    Discover active artisan shops across Malaysia, filter by negeri, category, and product name, and see them on the interactive map.
                </p>
            </div>
            <a href="<?php echo e(route('shops.map')); ?>" class="inline-flex items-center px-4 py-2 rounded-lg border border-neutral-300 text-neutral-700 hover:bg-neutral-100 text-sm font-medium bg-white shadow-sm">
                <i class="fas fa-expand mr-2"></i>
                Open Full Map View
            </a>
        </div>

        <!-- Search + Map + List (same layout as map.blade.php) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Search panel -->
            <div class="bg-white rounded-2xl shadow-md border border-neutral-200 p-6 flex flex-col gap-4">
                <h3 class="text-sm font-semibold text-neutral-900 uppercase tracking-wide flex items-center gap-2">
                    <i class="fas fa-location-crosshairs text-primary-600"></i>
                    <span>Find Nearby Shops</span>
                </h3>
                <p class="text-xs text-neutral-600">Use your current location or enter coordinates to search within a radius and filter by state, category, or product name.</p>

                

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-2">
                    <div>
                        <label for="state" class="block text-xs font-semibold text-neutral-700 uppercase mb-1">State (Negeri)</label>
                        <select id="state" class="w-full px-3 py-2 rounded-lg border border-neutral-300 text-sm bg-white focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-200">
                            <option value="">All States</option>
                            <?php if(isset($states)): ?>
                                <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($state); ?>"><?php echo e($state); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div>
                        <label for="category" class="block text-xs font-semibold text-neutral-700 uppercase mb-1">Category</label>
                        <select id="category" class="w-full px-3 py-2 rounded-lg border border-neutral-300 text-sm bg-white focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-200">
                            <option value="">All Categories</option>
                            <?php if(isset($categories)): ?>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category); ?>"><?php echo e($category); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
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
                        Search Shops
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
</section>

<!-- Stats Section -->


<!-- Featured Products Section -->
<section class="bg-gradient-to-br from-secondary-50 via-secondary-100 to-neutral-0 py-5 relative overflow-hidden">
    <div class="absolute inset-0 opacity-3">
        <div class="absolute top-0 right-0 w-96 h-96 bg-accent-400 rounded-full mix-blend-multiply filter blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary-400 rounded-full mix-blend-multiply filter blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-secondary-400 rounded-full mix-blend-multiply filter blur-3xl"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="flex flex-col md:flex-row justify-between items-center mb-16">
            <div>
                <span class="inline-block bg-yellow-400 text-white px-4 py-2 rounded-full font-bold text-sm mb-4">
                    <i class="fas fa-star mr-2"></i>Best Picks
                </span>
                <h2 class="text-5xl font-bold bg-gradient-to-r from-primary-700 via-accent-600 to-secondary-600 bg-clip-text text-transparent mb-4">Products</h2>
                <div class="h-1 w-32 bg-gradient-to-r from-primary-600 via-accent-600 to-secondary-600 rounded-full"></div>
            </div>
            <a href="<?php echo e(route('products.shop')); ?>" class="mt-6 md:mt-0 bg-gradient-to-r from-accent-500 to-accent-600 hover:from-accent-600 hover:to-accent-700 text-white font-bold py-3 px-8 rounded-lg transition shadow-lg hover:shadow-2xl transform hover:scale-105 flex items-center gap-2">
                View All Products <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php $__empty_1 = true; $__currentLoopData = \App\Models\Product::with('artisan')->limit(8)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-gradient-to-br from-neutral-0 to-neutral-50 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group hover:translate-y-[-12px] border-t-4 border-primary-400 relative hover:border-primary-500">
                <!-- Decorative corners -->
                <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-bl from-secondary-100 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>

                <!-- Product Image -->
                <div class="relative h-64 bg-gradient-to-br from-neutral-200 to-neutral-300 overflow-hidden">
                    <?php if($product->image_path): ?>
                        <img src="<?php echo e(asset('storage/' . $product->image_path)); ?>" alt="<?php echo e($product->name); ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-500 brightness-100 group-hover:brightness-110">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary-100 to-secondary-100">
                            <i class="fas fa-box text-neutral-400 text-6xl"></i>
                        </div>
                    <?php endif; ?>

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
                    <h3 class="text-lg font-bold text-neutral-900 mb-3 line-clamp-2 group-hover:text-accent-700 transition"><?php echo e($product->name); ?></h3>

                    <!-- Artisan Info -->
                    <?php if($product->artisan): ?>
                    <div class="mb-4 p-3 bg-gradient-to-r from-primary-50 to-secondary-50 rounded-lg border-l-4 border-primary-500">
                        <p class="text-sm text-primary-800 flex items-center gap-2 mb-2 font-semibold">
                            <i class="fas fa-user-circle text-primary-600 text-base"></i>
                            <?php echo e($product->artisan->name); ?>

                        </p>
                        <?php
                            $shop = $product->artisan->shops()->first();
                        ?>
                        <?php if($shop): ?>
                        <p class="text-xs text-secondary-700 flex items-center gap-2">
                            <i class="fas fa-map-pin text-secondary-600"></i>
                            <?php echo e($shop->address ?? 'Lokasi tidak tersedia'); ?>

                        </p>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <!-- Divider with gradient -->
                    <div class="border-t-2 border-gradient-to-r from-transparent via-neutral-300 to-transparent my-4"></div>

                    <!-- Price & Actions -->
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-xs text-neutral-600 uppercase tracking-wider mb-1 font-bold">Price</p>
                            <p class="text-xl font-bold bg-gradient-to-r from-accent-500 to-accent-700 bg-clip-text text-transparent">RM <?php echo e(number_format($product->price, 2)); ?></p>
                        </div>
                        <div class="flex flex-col items-end gap-2">
                            <a href="<?php echo e(route('products.show', $product->id)); ?>" class="bg-gradient-to-br from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-bold py-2 px-4 rounded-xl transition shadow-lg hover:shadow-2xl flex items-center justify-center text-xs">
                                <i class="fas fa-eye text-sm mr-1"></i>
                                <span>View</span>
                            </a>
                            <form method="POST" action="<?php echo e(route('cart.add', $product)); ?>" class="inline-flex">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 text-xs font-semibold text-accent-700 bg-accent-50 rounded-xl hover:bg-accent-100 transition shadow-sm">
                                    <i class="fas fa-cart-plus mr-1"></i>
                                    <span>Add</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full text-center py-16">
                <i class="fas fa-box-open text-7xl text-neutral-300 mb-4 opacity-50"></i>
                <p class="text-neutral-600 text-lg font-semibold">No products available yet</p>
                <p class="text-neutral-500 text-sm mt-2">Products will be available soon</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>


<!-- Shop Our Most-Loved Categories Section -->


<?php $__env->startSection('js'); ?>
<script>
    const map = L.map('map').setView([3.1357, 101.6689], 12);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(map);

    let userMarker = null;
    let shopMarkers = [];

    <?php
        $allShops = \App\Models\Shop::where('status', 'active')
            ->with(['artisan.products'])
            ->get()
            ->map(function ($shop) {
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
    ?>

    const allShops = <?php echo json_encode($allShops, 15, 512) ?>;

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
                    <a href="/shops/${shop.id}" class="inline-flex items-center mt-2 mb-2 px-4 py-2 rounded-lg border border-primary-200 text-[11px] font-semibold text-primary-700 bg-white hover:bg-primary-50">
                        <i class="fas fa-arrow-right mr-1"></i>
                        View Shop
                    </a>
                    <?php if($shop->latitude && $shop->longitude): ?>
                    <a href="https://www.google.com/maps/?q=<?php echo e($shop->latitude); ?>,<?php echo e($shop->longitude); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-gradient-to-r from-accent-500 to-accent-600 text-white text-sm font-semibold shadow-md hover:from-accent-600 hover:to-accent-700 transition">
                        <i class="fas fa-map mr-2"></i>
                        <span> Go To Shop</span>
                    </a>
                <?php endif; ?>
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

                // Store the coordinates in data attributes for use in search
                document.getElementById('searchBtn').dataset.latitude = lat.toFixed(4);
                document.getElementById('searchBtn').dataset.longitude = lng.toFixed(4);

                // Center map on user location
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

                // Show success feedback
                const btn = document.getElementById('getCurrentLocation');
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-check mr-2"></i>Location captured!';
                btn.classList.add('bg-emerald-100', 'text-emerald-700', 'border-emerald-300');
                btn.classList.remove('bg-neutral-100', 'text-neutral-800', 'border-neutral-300');

                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.classList.remove('bg-emerald-100', 'text-emerald-700', 'border-emerald-300');
                    btn.classList.add('bg-neutral-100', 'text-neutral-800', 'border-neutral-300');
                }, 2000);
            }, function(error) {
                console.error('Geolocation error:', error);
                alert('Unable to get your location. Please enable location services and try again.');
            });
        } else {
            alert('Geolocation is not supported by your browser.');
        }
    });

    document.getElementById('searchBtn').addEventListener('click', function() {
        const searchBtn = document.getElementById('searchBtn');

        // Check if coordinates were stored from getCurrentLocation
        const storedLat = searchBtn.dataset.latitude;
        const storedLng = searchBtn.dataset.longitude;

        const lat = storedLat ? parseFloat(storedLat) : NaN;
        const lng = storedLng ? parseFloat(storedLng) : NaN;
        const radius = 5; // Default radius in km

        const state = document.getElementById('state').value;
        const category = document.getElementById('category').value;
        const productName = document.getElementById('product_name').value;

        const hasCoords = !isNaN(lat) && !isNaN(lng);

        if (hasCoords) {
            // Use coordinates-based search
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

            fetch(`<?php echo e(route('shops.nearby')); ?>?${params.toString()}`)
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

                    // Clear the stored coordinates after search
                    delete searchBtn.dataset.latitude;
                    delete searchBtn.dataset.longitude;
                })
                .catch(error => {
                    console.error('Search error:', error);
                    alert('An error occurred while searching for shops.');
                });
        } else {
            // Use filter-based search
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
                alert('Please use your current location or select at least one filter (state, category, or product name).');
                return;
            }

            fetch(`<?php echo e(route('shops.filter')); ?>?${params.toString()}`)
                .then(response => response.json())
                .then(data => {
                    renderShopsOnMap(data);
                    renderShopList(data, 'Filtered Shops');
                })
                .catch(error => {
                    console.error('Search error:', error);
                    alert('An error occurred while filtering shops.');
                });
        }
    });

    // Load all active shops on page load
    renderShopsOnMap(allShops);
    renderShopList(allShops, 'All Active Shops');
</script>

<!-- Splash Popup -->
<?php echo $__env->make('splash-popup', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/leezanm/eAsli-app/resources/views/welcome.blade.php ENDPATH**/ ?>