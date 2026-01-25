@extends('layouts.app')

@section('title', 'Edit Customer')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-10">
    <!-- Page header -->
    <div class="flex items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-neutral-900 flex items-center gap-3">
                <span class="inline-flex items-center justify-center w-11 h-11 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 text-white shadow-lg">
                    <i class="fas fa-user-edit text-lg"></i>
                </span>
                <span>Edit Customer</span>
            </h1>
            <p class="mt-2 text-neutral-600 text-sm md:text-base">Update customer information and details.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg text-green-700 flex items-start gap-3 animate-pulse">
            <i class="fas fa-check-circle text-green-600 mt-0.5 text-lg"></i>
            <span class="font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-md border border-secondary-200 p-8">
        <form method="POST" action="{{ route('customers.update', $customer) }}">
            @csrf
            @method('PUT')

            <!-- Name & Email Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="name" class="block text-sm font-semibold text-neutral-700 uppercase tracking-wider mb-2">Full Name *</label>
                    <input type="text" class="w-full px-4 py-3 rounded-lg border @error('name') border-red-500 @else border-neutral-300 @enderror text-sm focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition"
                        id="name" name="name" value="{{ old('name', $customer->name) }}" required>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-neutral-700 uppercase tracking-wider mb-2">Email *</label>
                    <input type="email" class="w-full px-4 py-3 rounded-lg border @error('email') border-red-500 @else border-neutral-300 @enderror text-sm focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition"
                        id="email" name="email" value="{{ old('email', $customer->email) }}" required>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Phone -->
            <div class="mb-6">
                <label for="phone" class="block text-sm font-semibold text-neutral-700 uppercase tracking-wider mb-2">Phone Number *</label>
                <input type="tel" class="w-full px-4 py-3 rounded-lg border @error('phone') border-red-500 @else border-neutral-300 @enderror text-sm focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition"
                    id="phone" name="phone" value="{{ old('phone', $customer->phone) }}" required>
                @error('phone')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Address -->
            <div class="mb-6">
                <label for="address" class="block text-sm font-semibold text-neutral-700 uppercase tracking-wider mb-2">Address</label>
                <textarea class="w-full px-4 py-3 rounded-lg border @error('address') border-red-500 @else border-neutral-300 @enderror text-sm focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition" rows="3"
                    id="address" name="address">{{ old('address', $customer->address) }}</textarea>
                @error('address')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

         

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3">
                <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg bg-gradient-to-r from-primary-600 to-primary-500 text-white text-sm font-semibold shadow-md hover:from-primary-700 hover:to-primary-600 transition transform hover:scale-105">
                    <i class="fas fa-save"></i>
                    <span>Save Changes</span>
                </button>
                <a href="{{ route('customers.show', $customer) }}" class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg bg-neutral-100 hover:bg-neutral-200 text-neutral-800 text-sm font-semibold border border-neutral-300 transition">
                    <i class="fas fa-times"></i>
                    <span>Cancel</span>
                </a>
            </div>
        </form>
    </div>

    <!-- Back Link -->
    <div class="mt-6">
        <a href="{{ route('customers.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-primary-700 hover:text-primary-800 transition">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Customers</span>
        </a>
    </div>
</div>
@endsection
