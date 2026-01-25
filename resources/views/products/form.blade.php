@extends('layouts.app')

@section('title', isset($product) ? 'Edit Product' : 'Create Product')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-neutral-100 to-neutral-50 py-10">
    <div class="max-w-4xl mx-auto px-4">
        <div class="bg-neutral-0 rounded-2xl shadow-2xl overflow-hidden border border-neutral-100">
            <!-- Header -->
            <div class="bg-gradient-to-r from-primary-700 to-primary-800 text-white p-8 md:p-10 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="inline-flex items-center justify-center w-11 h-11 rounded-full bg-primary-600/70 text-white text-xl">
                            <i class="fas fa-box"></i>
                        </span>
                        <h1 class="text-3xl font-bold">{{ isset($product) ? 'Edit Product' : 'Create Product' }}</h1>
                    </div>
                    <p class="text-primary-100 text-sm md:text-base">
                        {{ isset($product) ? 'Update product details, pricing, and stock.' : 'Add a new product to your catalog so customers can discover it.' }}
                    </p>
                </div>
                <div class="flex gap-2 flex-wrap justify-end">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-white/10 hover:bg-white/20 text-sm font-semibold">
                        <i class="fas fa-list mr-2"></i>
                        Back to Products
                    </a>
                </div>
            </div>

            <!-- Form -->
            <div class="p-8">
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded mb-6">
                        <strong>There were some problems with your input.</strong>
                        <ul class="mt-2 text-sm list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}" enctype="multipart/form-data">
                    @csrf
                    @if(isset($product)) @method('PUT') @endif

                    @if(!isset($product) && auth('artisan')->check())
                        <input type="hidden" name="artisan_id" value="{{ auth('artisan')->id() }}">
                    @endif

                    <div class="mb-6">
                        <label for="name" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                            <i class="fas fa-tag text-primary-600 mr-2"></i>Product Name *
                        </label>
                        <input type="text" id="name" name="name"
                               class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('name') border-red-500 @enderror"
                               value="{{ old('name', $product->name ?? '') }}" required>
                        @error('name')
                            <span class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                            <i class="fas fa-align-left text-primary-600 mr-2"></i>Description
                        </label>
                        <textarea id="description" name="description" rows="3"
                                  class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('description') border-red-500 @enderror">{{ old('description', $product->description ?? '') }}</textarea>
                        @error('description')
                            <span class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                        @enderror
                        <p class="mt-1 text-xs text-neutral-500">Describe the product, materials, size, or special features.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="category" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                                <i class="fas fa-folder-open text-primary-600 mr-2"></i>Category *
                            </label>
                            <select id="category" name="category"
                                    class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('category') border-red-500 @enderror"
                                    required>
                                @php($currentCategory = old('category', $product->category ?? ''))
                                <option value="" {{ $currentCategory === '' ? 'selected' : '' }}>Select a category</option>
                                <option value="electronics" {{ $currentCategory === 'electronics' ? 'selected' : '' }}>Electronics</option>
                                <option value="clothing" {{ $currentCategory === 'clothing' ? 'selected' : '' }}>Clothing</option>
                                <option value="food" {{ $currentCategory === 'food' ? 'selected' : '' }}>Food & Beverages</option>
                                <option value="crafts" {{ $currentCategory === 'crafts' ? 'selected' : '' }}>Handmade Crafts</option>
                                <option value="furniture" {{ $currentCategory === 'furniture' ? 'selected' : '' }}>Furniture</option>
                            </select>
                            @error('category')
                                <span class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                                <i class="fas fa-money-bill-wave text-primary-600 mr-2"></i>Price (RM) *
                            </label>
                            <input type="number" step="0.01" id="price" name="price"
                                   class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('price') border-red-500 @enderror"
                                   value="{{ old('price', $product->price ?? '') }}" required>
                            @error('price')
                                <span class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="stock" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                            <i class="fas fa-boxes-stacked text-primary-600 mr-2"></i>Stock Quantity *
                        </label>
                        <input type="number" id="stock" name="stock"
                               class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('stock') border-red-500 @enderror"
                               value="{{ old('stock', $product->stock ?? '') }}" required>
                        @error('stock')
                            <span class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                        @enderror
                    </div>

                    @if(isset($product))
                        <div class="mb-6">
                            <label for="status" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                                <i class="fas fa-toggle-on text-primary-600 mr-2"></i>Product Status *
                            </label>
                            @php($currentStatus = old('status', $product->status ?? 'available'))
                            <select id="status" name="status"
                                    class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('status') border-red-500 @enderror"
                                    required>
                                <option value="available" {{ $currentStatus === 'available' ? 'selected' : '' }}>Available</option>
                                <option value="unavailable" {{ $currentStatus === 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                            </select>
                            @error('status')
                                <span class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                        </div>
                    @endif

                    <div class="mb-8">
                        <label for="image_path" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                            <i class="fas fa-image text-primary-600 mr-2"></i>Product Image
                        </label>

                        <!-- Image Preview -->
                        @if(isset($product) && $product->image_path)
                            <div class="mb-4 p-4 bg-neutral-100 rounded-lg border border-neutral-300">
                                <p class="text-xs font-semibold text-neutral-700 mb-2">Current Image:</p>
                                <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" class="h-40 w-40 object-cover rounded-lg">
                            </div>
                        @endif

                        <!-- File Input -->
                        <div class="relative">
                            <input type="file" id="image_path" name="image_path" accept="image/*"
                                   class="w-full px-4 py-3 border-2 border-dashed border-neutral-300 rounded-lg bg-neutral-50 hover:border-primary-400 hover:bg-primary-50/40 transition cursor-pointer @error('image_path') border-red-500 bg-red-50 @enderror"
                                   onchange="previewImage(this)">
                            <p class="mt-2 text-xs text-neutral-500">
                                <i class="fas fa-cloud-upload-alt mr-1"></i>
                                Drag and drop or click to upload. Max 2MB (JPEG, PNG, GIF)
                            </p>
                        </div>

                        <!-- Image Preview on Upload -->
                        <div id="preview-container" class="mt-4" style="display:none;">
                            <p class="text-xs font-semibold text-neutral-700 mb-2">Preview:</p>
                            <img id="preview-image" src="" alt="Preview" class="h-40 w-40 object-cover rounded-lg border-2 border-primary-300">
                        </div>

                        @error('image_path')
                            <span class="text-red-600 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                        @enderror
                    </div>

                    <script>
                        function previewImage(input) {
                            const preview = document.getElementById('preview-container');
                            const previewImage = document.getElementById('preview-image');

                            if (input.files && input.files[0]) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    previewImage.src = e.target.result;
                                    preview.style.display = 'block';
                                };
                                reader.readAsDataURL(input.files[0]);
                            } else {
                                preview.style.display = 'none';
                            }
                        }
                    </script>

                    <div class="flex flex-col md:flex-row gap-4 mb-2">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105 duration-300 uppercase tracking-wide text-center">
                            <i class="fas fa-save mr-2"></i>{{ isset($product) ? 'Save Changes' : 'Create Product' }}
                        </button>
                        <a href="{{ route('products.index') }}" class="flex-1 bg-neutral-300 hover:bg-neutral-400 text-neutral-800 font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105 duration-300 uppercase tracking-wide text-center">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
