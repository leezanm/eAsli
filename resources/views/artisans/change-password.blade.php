@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-neutral-100 to-neutral-50 py-10">
    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-neutral-200">
            <!-- Header -->
            <div class="bg-gradient-to-r from-primary-700 to-primary-800 text-white p-8">
                <div class="flex items-center gap-3 mb-2">
                    <span class="inline-flex items-center justify-center w-11 h-11 rounded-full bg-primary-600/70 text-white text-xl">
                        <i class="fas fa-lock"></i>
                    </span>
                    <h1 class="text-3xl font-bold">Change Password</h1>
                </div>
                <p class="text-primary-100 text-sm">Update your password to keep your account secure.</p>
            </div>

            <!-- Form -->
            <div class="p-8">
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded mb-6">
                        <strong>There were some errors.</strong>
                        <ul class="mt-2 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="flex items-center"><i class="fas fa-times mr-2"></i>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('artisans.update-password') }}">
                    @csrf
                    @method('PUT')

                    <!-- Current Password -->
                    <div class="mb-6">
                        <label for="current_password" class="block text-sm font-semibold text-neutral-900 mb-2">
                            <i class="fas fa-key mr-2 text-primary-600"></i>Current Password
                        </label>
                        <input
                            type="password"
                            id="current_password"
                            name="current_password"
                            class="w-full px-4 py-3 rounded-lg border border-neutral-300 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-100 transition @error('current_password') border-red-500 @enderror"
                            placeholder="Enter your current password"
                            required
                        >
                        @error('current_password')
                            <p class="text-red-600 text-sm mt-2"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-semibold text-neutral-900 mb-2">
                            <i class="fas fa-shield-alt mr-2 text-primary-600"></i>New Password
                        </label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="w-full px-4 py-3 rounded-lg border border-neutral-300 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-100 transition @error('password') border-red-500 @enderror"
                            placeholder="Enter new password (minimum 6 characters)"
                            required
                            minlength="6"
                        >
                        <div class="mt-2 text-xs text-neutral-600">
                            <p class="flex items-center mb-1"><i class="fas fa-info-circle mr-2 text-primary-500"></i>At least 6 characters</p>
                        </div>
                        @error('password')
                            <p class="text-red-600 text-sm mt-2"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-8">
                        <label for="password_confirmation" class="block text-sm font-semibold text-neutral-900 mb-2">
                            <i class="fas fa-check-circle mr-2 text-primary-600"></i>Confirm New Password
                        </label>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="w-full px-4 py-3 rounded-lg border border-neutral-300 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-100 transition @error('password_confirmation') border-red-500 @enderror"
                            placeholder="Re-enter new password"
                            required
                            minlength="6"
                        >
                        @error('password_confirmation')
                            <p class="text-red-600 text-sm mt-2"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-4">
                        <button
                            type="submit"
                            class="flex-1 px-6 py-3 rounded-lg bg-primary-600 hover:bg-primary-700 text-white font-semibold transition flex items-center justify-center gap-2"
                        >
                            <i class="fas fa-save"></i>
                            Change Password
                        </button>
                        <a
                            href="{{ route('artisans.dashboard') }}"
                            class="flex-1 px-6 py-3 rounded-lg border border-neutral-300 text-neutral-800 hover:bg-neutral-50 font-semibold transition flex items-center justify-center gap-2"
                        >
                            <i class="fas fa-times"></i>
                            Cancel
                        </a>
                    </div>
                </form>

                <!-- Security Info -->
                <div class="mt-8 pt-8 border-t border-neutral-200">
                    <div class="bg-primary-50 rounded-lg p-6 border border-primary-200">
                        <h3 class="font-semibold text-primary-900 mb-3 flex items-center gap-2">
                            <i class="fas fa-shield-alt text-primary-600"></i>
                            Password Security Tips
                        </h3>
                        <ul class="text-sm text-primary-800 space-y-2">
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check-circle text-primary-600 mt-0.5 flex-shrink-0"></i>
                                <span>Use a strong password with uppercase, lowercase, numbers, and symbols</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check-circle text-primary-600 mt-0.5 flex-shrink-0"></i>
                                <span>Avoid using personal information like names or birthdates</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check-circle text-primary-600 mt-0.5 flex-shrink-0"></i>
                                <span>Never share your password with anyone</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check-circle text-primary-600 mt-0.5 flex-shrink-0"></i>
                                <span>Change your password regularly for better security</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
