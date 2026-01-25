@extends('layouts.app')

@section('title', isset($shop) ? 'Edit Shop' : 'Create Shop')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-neutral-100 to-neutral-50 py-10">
    <div class="max-w-4xl mx-auto px-4">
        <div class="bg-neutral-0 rounded-2xl shadow-2xl overflow-hidden border border-neutral-100">
            <!-- Header -->
            <div class="bg-gradient-to-r from-primary-700 to-primary-800 text-white p-8 md:p-10 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="inline-flex items-center justify-center w-11 h-11 rounded-full bg-primary-600/70 text-white text-xl">
                            <i class="fas fa-shop"></i>
                        </span>
                        <h1 class="text-3xl font-bold">{{ isset($shop) ? 'Edit Shop' : 'Create Shop' }}</h1>
                    </div>
                    <p class="text-primary-100 text-sm md:text-base">
                        {{ isset($shop) ? 'Update your shop details and location.' : 'Set up a new shop so customers can find your products.' }}
                    </p>
                </div>
                <div class="flex gap-2 flex-wrap justify-end">
                    <a href="{{ route('shops.index') }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-white/10 hover:bg-white/20 text-sm font-semibold">
                        <i class="fas fa-list mr-2"></i>
                        Back to Shops
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

                <form method="POST" action="{{ isset($shop) ? route('shops.update', $shop) : route('shops.store') }}">
                    @csrf
                    @if(isset($shop)) @method('PUT') @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="name" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                                <i class="fas fa-store text-primary-600 mr-2"></i>Shop Name *
                            </label>
                            <input type="text" id="name" name="name"
                                   class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('name') border-red-500 @enderror"
                                   value="{{ old('name', $shop->name ?? '') }}" required>
                            @error('name')
                                <span class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                                <i class="fas fa-phone text-primary-600 mr-2"></i>Contact Number
                            </label>
                            <input type="tel" id="phone" name="phone"
                                   class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('phone') border-red-500 @enderror"
                                   value="{{ old('phone', $shop->phone ?? '') }}">
                            @error('phone')
                                <span class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="address" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                            <i class="fas fa-map-marker-alt text-primary-600 mr-2"></i>Shop Address / Location *
                        </label>
                        <input type="text" id="address" name="address"
                               class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('address') border-red-500 @enderror"
                               value="{{ old('address', $shop->address ?? '') }}" required>
                        @error('address')
                            <span class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                        @enderror
                        <p class="mt-1 text-xs text-neutral-500">Use a clear location name or full address so customers can easily find your shop.</p>
                    </div>

                    <div class="mb-6">
                        <label for="state" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                            <i class="fas fa-flag text-primary-600 mr-2"></i>State / Region
                        </label>
                        <select id="state" name="state"
                                class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('state') border-red-500 @enderror">
                            <option value="">-- Select State (Negeri) --</option>
                            @isset($states)
                                @foreach($states as $state)
                                    <option value="{{ $state }}" {{ old('state', $shop->state ?? '') === $state ? 'selected' : '' }}>{{ $state }}</option>
                                @endforeach
                            @endisset
                        </select>
                        @error('state')
                            <span class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                        @enderror
                        <p class="mt-1 text-xs text-neutral-500">Choose the negeri where your shop is located.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="latitude" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                                <i class="fas fa-location-arrow text-primary-600 mr-2"></i>Latitude *
                            </label>
                            <input type="number" step="0.0001" id="latitude" name="latitude"
                                   class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('latitude') border-red-500 @enderror"
                                   value="{{ old('latitude', $shop->latitude ?? '') }}" required>
                            @error('latitude')
                                <span class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="longitude" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                                <i class="fas fa-location-crosshairs text-primary-600 mr-2"></i>Longitude *
                            </label>
                            <input type="number" step="0.0001" id="longitude" name="longitude"
                                   class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('longitude') border-red-500 @enderror"
                                   value="{{ old('longitude', $shop->longitude ?? '') }}" required>
                            @error('longitude')
                                <span class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-8">
                        <label for="description" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                            <i class="fas fa-file-alt text-primary-600 mr-2"></i>Shop Description
                        </label>
                        <textarea id="description" name="description" rows="3"
                                  class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('description') border-red-500 @enderror">{{ old('description', $shop->description ?? '') }}</textarea>
                        @error('description')
                            <span class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                        @enderror
                        <p class="mt-1 text-xs text-neutral-500">Tell customers what makes your shop special (products, style, story).</p>
                    </div>

                    <div class="flex flex-col md:flex-row gap-4 mb-2">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105 duration-300 uppercase tracking-wide text-center">
                            <i class="fas fa-save mr-2"></i>{{ isset($shop) ? 'Save Changes' : 'Create Shop' }}
                        </button>
                        <a href="{{ route('shops.index') }}" class="flex-1 bg-neutral-300 hover:bg-neutral-400 text-neutral-800 font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105 duration-300 uppercase tracking-wide text-center">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
