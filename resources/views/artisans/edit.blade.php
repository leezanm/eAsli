@extends('layouts.app')

@section('title', 'Edit Artisan')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-neutral-100 to-neutral-50 py-10">
    <div class="max-w-3xl mx-auto px-4">
        <div class="bg-neutral-0 rounded-2xl shadow-2xl overflow-hidden border border-neutral-100">
            <!-- Header -->
            <div class="bg-gradient-to-r from-primary-700 to-primary-800 text-white p-8 md:p-10 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="inline-flex items-center justify-center w-11 h-11 rounded-full bg-primary-600/70 text-white text-xl">
                            <i class="fas fa-user-cog"></i>
                        </span>
                        <h1 class="text-3xl font-bold">Edit Artisan</h1>
                    </div>
                    <p class="text-primary-100 text-sm md:text-base">Update artisan details, business information, and status.</p>
                </div>
                <div class="flex gap-2 flex-wrap justify-end">
                    <a href="{{ route('artisans.show', $artisan) }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-white/10 hover:bg-white/20 text-sm font-semibold">
                        <i class="fas fa-eye mr-2"></i>
                        View Profile
                    </a>
                    <a href="{{ route('artisans.index') }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-white/10 hover:bg-white/20 text-sm font-semibold">
                        <i class="fas fa-list mr-2"></i>
                        Back to List
                    </a>
                </div>
            </div>

            <!-- Form -->
            <div class="p-8">
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded mb-6">
                        <strong>There were some errors.</strong>
                        <ul class="mt-2 text-sm">
                            @foreach ($errors->all() as $error)
                                <li class="flex items-center"><i class="fas fa-times mr-2"></i>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('artisans.update', $artisan) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="name" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                                <i class="fas fa-user text-primary-600 mr-2"></i>Full Name *
                            </label>
                            <input type="text" id="name" name="name"
                                   class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('name') border-red-500 @enderror"
                                   value="{{ old('name', $artisan->name) }}" required>
                            @error('name')
                                <span class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                                <i class="fas fa-envelope text-primary-600 mr-2"></i>Email *
                            </label>
                            <input type="email" id="email" name="email"
                                   class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('email') border-red-500 @enderror"
                                   value="{{ old('email', $artisan->email) }}" required>
                            @error('email')
                                <span class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="phone" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                                <i class="fas fa-phone text-primary-600 mr-2"></i>Phone Number *
                            </label>
                            <input type="tel" id="phone" name="phone"
                                   class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('phone') border-red-500 @enderror"
                                   value="{{ old('phone', $artisan->phone) }}" required>
                            @error('phone')
                                <span class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                        </div>

                        @if(auth('web')->check())
                            <div>
                                <label for="status" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                                    <i class="fas fa-toggle-on text-primary-600 mr-2"></i>Status *
                                </label>
                                <select id="status" name="status"
                                        class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('status') border-red-500 @enderror"
                                        required>
                                    @php($currentStatus = old('status', $artisan->status ?? 'active'))
                                    <option value="active" {{ $currentStatus === 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ $currentStatus === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <span class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>

                    <div class="mb-6">
                        <label for="address" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                            <i class="fas fa-map-marker-alt text-primary-600 mr-2"></i>Address
                        </label>
                        <textarea id="address" name="address" rows="2"
                                  class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('address') border-red-500 @enderror">{{ old('address', $artisan->address) }}</textarea>
                        @error('address')
                            <span class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-8">
                        <label for="description" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                            <i class="fas fa-file-alt text-primary-600 mr-2"></i>Business Description
                        </label>
                        <textarea id="description" name="description" rows="3"
                                  class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('description') border-red-500 @enderror">{{ old('description', $artisan->description) }}</textarea>
                        @error('description')
                            <span class="text-red-600 text-sm mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col md:flex-row gap-4 mb-2">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105 duration-300 uppercase tracking-wide text-center">
                            <i class="fas fa-save mr-2"></i>Save Changes
                        </button>
                        <a href="{{ route('artisans.show', $artisan) }}" class="flex-1 bg-neutral-300 hover:bg-neutral-400 text-neutral-800 font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105 duration-300 uppercase tracking-wide text-center">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
