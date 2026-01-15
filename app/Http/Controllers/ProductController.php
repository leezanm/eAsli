<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $search = request('search');
        $category = request('category');

        $query = Product::with('artisan');

        // If an artisan is logged in, only show their own products
        if (Auth::guard('artisan')->check()) {
            $query->where('artisan_id', Auth::guard('artisan')->id());
        }

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        if ($category) {
            $query->where('category', $category);
        }

        $products = $query->paginate(12);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        if (!Auth::guard('artisan')->check()) {
            return redirect()->route('artisans.login');
        }

        $shops = Auth::guard('artisan')->user()->shops;
        return view('products.form', compact('shops'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'artisan_id' => 'required|exists:artisans,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image_path')) {
            // Store on the public disk so it is web-accessible via Storage::url
            $validated['image_path'] = $request->file('image_path')->store('products', 'public');
        }

        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    public function show(Product $product)
    {
        // Artisans may only view their own products
        if (Auth::guard('artisan')->check() && $product->artisan_id !== Auth::guard('artisan')->id()) {
            abort(403);
        }

        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        // Artisans may only edit their own products
        if (Auth::guard('artisan')->check() && $product->artisan_id !== Auth::guard('artisan')->id()) {
            abort(403);
        }

        // Show the same form used for creation, pre-filled with product data
        return view('products.form', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        // Artisans may only update their own products
        if (Auth::guard('artisan')->check() && $product->artisan_id !== Auth::guard('artisan')->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:available,unavailable',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image_path')) {
            // Optionally remove old image
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }

            $validated['image_path'] = $request->file('image_path')->store('products', 'public');
        } else {
            // Do not overwrite existing image_path with null if no new image uploaded
            unset($validated['image_path']);
        }

        $product->update($validated);
        return redirect()->route('products.show', $product)->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        // Artisans may only delete their own products
        if (Auth::guard('artisan')->check() && $product->artisan_id !== Auth::guard('artisan')->id()) {
            abort(403);
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }

    public function byCategory(Request $request)
    {
        $category = $request->input('category');
        $products = Product::where('category', $category)->where('status', 'available')->get();
        return view('products.by-category', compact('products', 'category'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $products = Product::where('status', 'available')
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            })
            ->get();
        return view('products.search', compact('products', 'search'));
    }

    public function lowStock()
    {
        $products = Product::where('stock', '<', 10)->get();
        return view('products.low-stock', compact('products'));
    }
}
