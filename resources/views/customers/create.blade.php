@extends('layouts.app')

@section('title', 'Register Customer')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-50 via-secondary-50 to-neutral-0 py-10 px-4">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-accent-500 to-accent-600 text-white shadow-lg mb-4">
                <i class="fas fa-user-plus text-2xl"></i>
            </div>
            <h1 class="text-4xl font-bold text-neutral-900 mb-2">Create Your Account</h1>
            <p class="text-neutral-600 text-lg">Join eAsli and start shopping from our artisans</p>
        </div>

        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <!-- Form -->
            <div class="p-8 md:p-10">
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-lg mb-8">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-triangle text-red-600 mr-3 mt-1"></i>
                            <div>
                                <strong class="block text-lg">Registration Failed</strong>
                                <ul class="mt-2 text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li class="flex items-center"><i class="fas fa-times mr-2"></i>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('customers.store') }}">
                    @csrf

                    <!-- Hidden redirect field -->
                    <input type="hidden" name="redirect_to" value="{{ request()->has('redirect_to') ? request('redirect_to') : request()->header('referer', route('home')) }}">

                    <!-- Name and Email Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="name" class="block text-sm font-bold text-primary-900 mb-3 uppercase tracking-wide">
                                <i class="fas fa-user text-primary-600 mr-2"></i>Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="name"
                                   class="w-full px-5 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('name') border-red-500 focus:border-red-500 @enderror"
                                   placeholder="John Doe"
                                   value="{{ old('name') }}"
                                   required>
                            @error('name')
                                <span class="text-red-600 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-bold text-primary-900 mb-3 uppercase tracking-wide">
                                <i class="fas fa-envelope text-primary-600 mr-2"></i>Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" id="email"
                                   class="w-full px-5 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('email') border-red-500 focus:border-red-500 @enderror"
                                   placeholder="customer@example.com"
                                   value="{{ old('email') }}"
                                   required>
                            @error('email')
                                <span class="text-red-600 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Phone Number -->
                    <div class="mb-6">
                        <label for="phone" class="block text-sm font-bold text-primary-900 mb-3 uppercase tracking-wide">
                            <i class="fas fa-phone text-primary-600 mr-2"></i>Phone Number <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" name="phone" id="phone"
                               class="w-full px-5 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('phone') border-red-500 focus:border-red-500 @enderror"
                               placeholder="601234567890"
                               value="{{ old('phone') }}"
                               required>
                        @error('phone')
                            <span class="text-red-600 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="mb-6">
                        <label for="address" class="block text-sm font-bold text-primary-900 mb-3 uppercase tracking-wide">
                            <i class="fas fa-map-marker-alt text-primary-600 mr-2"></i>Address
                        </label>
                        <textarea name="address" id="address" rows="3"
                                  class="w-full px-5 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('address') border-red-500 focus:border-red-500 @enderror"
                                  placeholder="Your delivery address">{{ old('address') }}</textarea>
                        @error('address')
                            <span class="text-red-600 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password and Confirm Password Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label for="password" class="block text-sm font-bold text-primary-900 mb-3 uppercase tracking-wide">
                                <i class="fas fa-lock text-primary-600 mr-2"></i>Password <span class="text-red-500">*</span>
                            </label>
                            <input type="password" name="password" id="password"
                                   class="w-full px-5 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('password') border-red-500 focus:border-red-500 @enderror"
                                   placeholder="••••••••••••"
                                   required>
                            @error('password')
                                <span class="text-red-600 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-bold text-primary-900 mb-3 uppercase tracking-wide">
                                <i class="fas fa-lock text-primary-600 mr-2"></i>Confirm Password <span class="text-red-500">*</span>
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="w-full px-5 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium"
                                   placeholder="••••••••••••"
                                   required>
                        </div>
                    </div>

                    <!-- Terms -->
                    <div class="mb-8 p-4 bg-neutral-50 rounded-lg border border-neutral-200">
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" name="agree_terms" class="mt-1 w-5 h-5 text-primary-600 rounded focus:ring-2 focus:ring-primary-500" required>
                            <span class="text-sm text-neutral-700">
                                I agree to the <a href="#" class="text-primary-700 hover:text-primary-800 font-semibold">Terms & Conditions</a> and <a href="#" class="text-primary-700 hover:text-primary-800 font-semibold">Privacy Policy</a>
                            </span>
                        </label>
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-accent-500 to-accent-600 hover:from-accent-600 hover:to-accent-700 text-white font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105 duration-300 uppercase tracking-wide flex items-center justify-center gap-2">
                            <i class="fas fa-user-plus"></i>Create Account
                        </button>
                        <a href="{{ route('home') }}" class="flex-1 bg-neutral-100 hover:bg-neutral-200 text-neutral-800 font-bold py-3 px-4 rounded-lg shadow-md hover:shadow-lg transition uppercase tracking-wide flex items-center justify-center gap-2">
                            <i class="fas fa-arrow-left"></i>Back
                        </a>
                    </div>

                    <!-- Login Link -->
                    <div class="text-center mt-6 pt-6 border-t border-neutral-200">
                        <p class="text-neutral-700 text-sm">Already have an account?
                            <a href="{{ route('customers.login') }}" class="text-primary-700 hover:text-primary-800 font-bold">Login here</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
