@extends('layouts.app')

@section('title', 'Register New Artisan')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-700 via-primary-600 to-secondary-600 flex items-center justify-center p-4 py-12">
    <div class="w-full max-w-2xl">
        <div class="bg-neutral-0 rounded-2xl shadow-2xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-primary-700 to-primary-800 text-white p-10 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 text-primary-600 opacity-10" style="font-size: 8rem;">
                    <i class="fas fa-user-plus"></i>
                </div>
                <i class="fas fa-user-tie text-5xl mb-4 relative z-10 text-accent-400"></i>
                <h1 class="text-4xl font-bold mt-4">Register New Artisan</h1>
                <p class="text-primary-100 mt-2 font-semibold">Submit your profile. Admin will review and approve your account.</p>
            </div>

            <!-- Form -->
            <div class="p-10">
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

                <form method="POST" action="{{ route('artisans.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="name" class="block text-sm font-bold text-primary-900 mb-3 uppercase tracking-wide">
                                <i class="fas fa-user text-primary-600 mr-2"></i>Full Name *
                            </label>
                            <input type="text" class="w-full px-5 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('name') border-red-500 @enderror"
                                id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="text-red-600 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-bold text-primary-900 mb-3 uppercase tracking-wide">
                                <i class="fas fa-envelope text-primary-600 mr-2"></i>Email *
                            </label>
                            <input type="email" class="w-full px-5 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('email') border-red-500 @enderror"
                                id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="text-red-600 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="phone" class="block text-sm font-bold text-primary-900 mb-3 uppercase tracking-wide">
                                <i class="fas fa-phone text-primary-600 mr-2"></i>Phone Number *
                            </label>
                            <input type="tel" class="w-full px-5 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('phone') border-red-500 @enderror"
                                id="phone" name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                                <span class="text-red-600 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-bold text-primary-900 mb-3 uppercase tracking-wide">
                                <i class="fas fa-lock text-primary-600 mr-2"></i>Password *
                            </label>
                            <input type="password" class="w-full px-5 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('password') border-red-500 @enderror"
                                id="password" name="password" required>
                            @error('password')
                                <span class="text-red-600 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="address" class="block text-sm font-bold text-primary-900 mb-3 uppercase tracking-wide">
                            <i class="fas fa-map-marker-alt text-primary-600 mr-2"></i>Address
                        </label>
                        <textarea class="w-full px-5 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('address') border-red-500 @enderror"
                            id="address" name="address" rows="2">{{ old('address') }}</textarea>
                        @error('address')
                            <span class="text-red-600 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-8">
                        <label for="description" class="block text-sm font-bold text-primary-900 mb-3 uppercase tracking-wide">
                            <i class="fas fa-file-alt text-primary-600 mr-2"></i>Business Description
                        </label>
                        <textarea class="w-full px-5 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('description') border-red-500 @enderror"
                            id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-red-600 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex gap-4 mb-8">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105 duration-300 uppercase tracking-wide">
                            <i class="fas fa-user-plus mr-2"></i>Register Now
                        </button>
                        <a href="{{ route('home') }}" class="flex-1 bg-neutral-300 hover:bg-neutral-400 text-neutral-800 font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105 duration-300 uppercase tracking-wide text-center">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                    </div>

                    <!-- Divider -->
                    <div class="my-8 flex items-center">
                        <div class="flex-grow border-t border-neutral-300"></div>
                        <span class="px-4 text-neutral-500 text-sm">Already have an account?</span>
                        <div class="flex-grow border-t border-neutral-300"></div>
                    </div>

                    <!-- Login Link -->
                    <div class="text-center">
                        <a href="{{ route('artisans.login') }}" class="text-primary-700 hover:text-primary-800 font-bold">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login here
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
