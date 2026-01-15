@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-700 via-primary-600 to-secondary-600 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-neutral-0 rounded-2xl shadow-2xl overflow-hidden transform hover:shadow-3xl transition duration-300">
            <!-- Header -->
            <div class="bg-gradient-to-r from-primary-700 to-primary-800 text-white p-10 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 text-primary-600 opacity-10" style="font-size: 8rem;">
                    <i class="fas fa-lock"></i>
                </div>
                <i class="fas fa-user-shield text-5xl mb-4 relative z-10 text-accent-400"></i>
                <h1 class="text-4xl font-bold mt-4">Admin Panel</h1>
                <p class="text-primary-100 mt-2 font-semibold">eAsli Management System</p>
            </div>

            <!-- Form -->
            <div class="p-10">
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded mb-6 animate-bounce">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-triangle text-red-600 mr-3 mt-1"></i>
                            <div>
                                <strong class="block text-lg">Login Failed!</strong>
                                <ul class="mt-2 text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li class="flex items-center"><i class="fas fa-times mr-2"></i>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.authenticate') }}">
                    @csrf

                    <div class="mb-6">
                        <label for="email" class="block text-sm font-bold text-primary-900 mb-3 uppercase tracking-wide">
                            <i class="fas fa-envelope text-primary-600 mr-2"></i>Email Address
                        </label>
                        <input type="email" name="email" id="email"
                               class="w-full px-5 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('email') border-red-500 focus:border-red-500 @enderror"
                               placeholder="admin@easli.com"
                               value="{{ old('email') }}"
                               autofocus>
                        @error('email')
                            <span class="text-red-600 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-8">
                        <label for="password" class="block text-sm font-bold text-primary-900 mb-3 uppercase tracking-wide">
                            <i class="fas fa-lock text-primary-600 mr-2"></i>Password
                        </label>
                        <input type="password" name="password" id="password"
                               class="w-full px-5 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('password') border-red-500 focus:border-red-500 @enderror"
                               placeholder="••••••••••••">
                        @error('password')
                            <span class="text-red-600 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-8">
                        <label class="flex items-center cursor-pointer group">
                            <input type="checkbox" name="remember" class="w-5 h-5 rounded border-2 border-neutral-300 text-primary-600 focus:ring-primary-500 focus:ring-2 cursor-pointer">
                            <span class="ml-3 text-sm font-medium text-neutral-700 group-hover:text-primary-700">Remember me on this device</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105 duration-300 uppercase tracking-wide">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login Admin
                    </button>
                </form>

                <!-- Divider -->
                <div class="my-8 flex items-center">
                    <div class="flex-grow border-t border-gray-300"></div>
                    <span class="px-3 text-gray-500 text-sm">or</span>
                    <div class="flex-grow border-t border-gray-300"></div>
                </div>

                <!-- Additional Links -->
                <div class="flex flex-col gap-3">
                    <a href="{{ route('artisans.login') }}" class="text-center bg-primary-50 hover:bg-primary-100 text-primary-700 font-semibold py-3 rounded-lg transition">
                        <i class="fas fa-user-circle mr-2"></i>Login as Artisan
                    </a>
                    <a href="{{ route('home') }}" class="text-center text-primary-600 hover:text-primary-800 font-semibold py-2 transition">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Home
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="mt-8 text-center text-white text-sm">
            <p class="font-semibold mb-2">Demo Credentials:</p>
            <p>Email: <span class="font-mono bg-white bg-opacity-20 px-2 py-1 rounded">admin@easli.com</span></p>
            <p>Password: <span class="font-mono bg-white bg-opacity-20 px-2 py-1 rounded">admin123456</span></p>
        </div>
    </div>
</div>
@endsection
