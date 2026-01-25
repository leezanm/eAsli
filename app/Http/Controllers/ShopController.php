<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        if (Auth::guard('artisan')->check()) {
            $shops = Auth::guard('artisan')->user()->shops()->get();
        } else {
            $shops = Shop::with('artisan')->get();
        }
        return view('shops.index', compact('shops'));
    }

    public function create()
    {
        if (Auth::guard('artisan')->check()) {
            $artisan = Auth::guard('artisan')->user();
            $states = State::orderBy('name')->pluck('name');
            return view('shops.form', compact('artisan', 'states'));
        }
        return redirect()->route('artisans.login');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'state' => 'nullable|string|max:100',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'phone' => 'nullable|string|max:15',
            'description' => 'nullable|string',
        ]);

        // Auto-populate artisan_id from authenticated user
        if (Auth::guard('artisan')->check()) {
            $validated['artisan_id'] = Auth::guard('artisan')->user()->id;
        } else {
            return redirect()->route('artisans.login')->with('error', 'You must be logged in as an artisan to create a shop.');
        }

        Shop::create($validated);
        return redirect()->route('shops.index')->with('success', 'Shop created successfully');
    }

    public function show(Shop $shop)
    {
        $products = $shop->artisan->products()->get();
        return view('shops.show', compact('shop', 'products'));
    }

    public function edit(Shop $shop)
    {
        // Only allow the owning artisan or an admin to edit
        if (Auth::guard('artisan')->check()) {
            $artisan = Auth::guard('artisan')->user();
            if ($shop->artisan_id !== $artisan->id) {
                abort(403);
            }
        }

        $states = State::orderBy('name')->pluck('name');
        return view('shops.form', compact('shop', 'states'));
    }

    public function update(Request $request, Shop $shop)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'state' => 'nullable|string|max:100',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'phone' => 'nullable|string|max:15',
            'description' => 'nullable|string',
        ]);

        // Preserve existing status; it is not editable from the form
        $shop->update($validated);
        return redirect()->route('shops.show', $shop)->with('success', 'Shop updated successfully');
    }

    public function destroy(Shop $shop)
    {
        $shop->delete();
        return redirect()->route('shops.index')->with('success', 'Shop deleted successfully');
    }

    public function map()
    {
        $shops = Shop::where('status', 'active')
            ->with(['artisan.products'])
            ->get();

        $states = State::orderBy('name')
            ->pluck('name');

        $categories = Product::whereNotNull('category')
            ->distinct()
            ->pluck('category')
            ->sort()
            ->values();

        return view('shops.map', compact('shops', 'states', 'categories'));
    }

    public function nearbyShops(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $radius = $request->input('radius', 10); // default 10 km

        $state = $request->input('state');
        $category = $request->input('category');
        $productName = $request->input('product_name');

        $query = Shop::where('status', 'active')
            ->with(['artisan.products'])
            ->selectRaw(
                "*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance",
                [$latitude, $longitude, $latitude]
            );

        if ($state) {
            $query->where('state', $state);
        }

        if ($category || $productName) {
            $query->whereHas('artisan.products', function ($q) use ($category, $productName) {
                if ($category) {
                    $q->where('category', $category);
                }

                if ($productName) {
                    $q->where('name', 'like', '%' . $productName . '%');
                }
            });
        }

        $shops = $query
            ->having('distance', '<', $radius)
            ->orderBy('distance')
            ->get();

        $payload = $shops->map(function (Shop $shop) use ($category, $productName) {
            // Filter products based on the criteria
            $products = $shop->artisan
                ? $shop->artisan->products->filter(function ($product) use ($category, $productName) {
                    $matchesCategory = !$category || $product->category === $category;
                    $matchesName = !$productName || stripos($product->name, $productName) !== false;
                    return $matchesCategory && $matchesName;
                })->map(function (Product $product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                    ];
                })->values()->all()
                : [];

            return [
                'id' => $shop->id,
                'name' => $shop->name,
                'address' => $shop->address,
                'latitude' => $shop->latitude,
                'longitude' => $shop->longitude,
                'products_count' => count($products),
                'products' => $products,
            ];
        });

        return response()->json($payload);
    }

    public function filterShops(Request $request)
    {
        $state = $request->input('state');
        $category = $request->input('category');
        $productName = $request->input('product_name');

        $query = Shop::where('status', 'active')
            ->with(['artisan.products']);

        if ($state) {
            $query->where('state', $state);
        }

        if ($category || $productName) {
            $query->whereHas('artisan.products', function ($q) use ($category, $productName) {
                if ($category) {
                    $q->where('category', $category);
                }

                if ($productName) {
                    $q->where('name', 'like', '%' . $productName . '%');
                }
            });
        }

        $shops = $query->get();

        $payload = $shops->map(function (Shop $shop) use ($category, $productName) {
            // Filter products based on the criteria
            $products = $shop->artisan
                ? $shop->artisan->products->filter(function ($product) use ($category, $productName) {
                    $matchesCategory = !$category || $product->category === $category;
                    $matchesName = !$productName || stripos($product->name, $productName) !== false;
                    return $matchesCategory && $matchesName;
                })->map(function (Product $product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                    ];
                })->values()->all()
                : [];

            return [
                'id' => $shop->id,
                'name' => $shop->name,
                'address' => $shop->address,
                'latitude' => $shop->latitude,
                'longitude' => $shop->longitude,
                'products_count' => count($products),
                'products' => $products,
            ];
        });

        return response()->json($payload);
    }
}
