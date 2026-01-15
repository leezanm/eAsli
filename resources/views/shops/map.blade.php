@extends('layouts.app')

@section('title', 'Shop Map')

@section('css')
<style>
    #map {
        height: 600px;
        border-radius: 8px;
    }
    .search-box {
        background: white;
        padding: 1rem;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <div class="container">
        <h1><i class="fas fa-map"></i> Shop Map</h1>
        <p class="lead">Explore shops and products near your location.</p>
    </div>
</div>

<div class="container py-4">
    <div class="search-box mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <label for="latitude" class="form-label">Latitude</label>
                <input type="number" class="form-control" id="latitude" step="0.0001" placeholder="Example: 3.1357">
            </div>
            <div class="col-md-4">
                <label for="longitude" class="form-label">Longitude</label>
                <input type="number" class="form-control" id="longitude" step="0.0001" placeholder="Example: 101.6689">
            </div>
            <div class="col-md-4">
                <label for="radius" class="form-label">Radius (km)</label>
                <input type="number" class="form-control" id="radius" value="5" min="1">
            </div>
        </div>
        <button id="searchBtn" class="btn btn-primary mt-3">
            <i class="fas fa-search"></i> Find Nearby Shops
        </button>
        <button id="getCurrentLocation" class="btn btn-info mt-3">
            <i class="fas fa-location-arrow"></i> Use Current Location
        </button>
    </div>

    <div id="map"></div>

    <div id="shopList" class="mt-4">
        <!-- Shop list will be populated here -->
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

        if (!lat || !lng) {
            alert('Please enter both latitude and longitude');
            return;
        }

        fetch(`{{ route('shops.nearby') }}?latitude=${lat}&longitude=${lng}&radius=${radius}`)
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

                // Clear existing markers (handled by Leaflet layer state)

                let html = '<h5 class="mt-4">Nearby Shops (' + data.length + ')</h5><div class="row g-3">';

                data.forEach(shop => {
                    L.marker([shop.latitude, shop.longitude]).addTo(map)
                        .bindPopup(`<strong>${shop.name}</strong><br>${shop.location}`);

                    html += `
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">${shop.name}</h6>
                                    <p class="card-text text-muted small">${shop.location}</p>
                                    <p><small>Products: ${shop.products_count}</small></p>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <a href="/shops/${shop.id}" class="btn btn-sm btn-primary">View Shop</a>
                                </div>
                            </div>
                        </div>
                    `;
                });

                html += '</div>';
                document.getElementById('shopList').innerHTML = html;
            });
    });

    // Load all shops on page load
    document.getElementById('searchBtn').click();
</script>
@endsection
