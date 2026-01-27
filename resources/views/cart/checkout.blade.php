@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-50 via-secondary-50 to-neutral-0 py-10 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-neutral-900 mb-2 flex items-center gap-3">
                <span class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 text-white shadow-lg">
                    <i class="fas fa-credit-card text-lg"></i>
                </span>
                <span>Checkout</span>
            </h1>
            <p class="text-neutral-600 text-lg">Complete your purchase by providing your details and selecting a payment method</p>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-lg mb-8">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-triangle text-red-600 mr-3 mt-1"></i>
                    <div>
                        <strong class="block text-lg">Checkout Error</strong>
                        <ul class="mt-2 text-sm">
                            @foreach ($errors->all() as $error)
                                <li class="flex items-center"><i class="fas fa-times mr-2"></i>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('cart.process') }}" class="space-y-6" onsubmit="enableReceiverFieldsBeforeSubmit()">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Billing Information -->
                    <div class="bg-white rounded-2xl shadow-md border border-secondary-200 p-8">
                        <h2 class="text-2xl font-bold text-neutral-900 mb-6 pb-4 border-b-2 border-neutral-200">
                            <i class="fas fa-map-marker-alt text-primary-600 mr-2"></i>Billing Information
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="bill_name" class="block text-sm font-bold text-primary-900 mb-3 uppercase tracking-wide">
                                    <i class="fas fa-user text-primary-600 mr-2"></i>Full Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="bill_name" id="bill_name"
                                       class="w-full px-5 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('bill_name') border-red-500 @enderror"
                                       placeholder="John Doe"
                                       value="{{ old('bill_name', auth('customer')->user()->name) }}"
                                       required>
                                @error('bill_name')
                                    <span class="text-red-600 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="bill_phone" class="block text-sm font-bold text-primary-900 mb-3 uppercase tracking-wide">
                                    <i class="fas fa-phone text-primary-600 mr-2"></i>Phone Number <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" name="bill_phone" id="bill_phone"
                                       class="w-full px-5 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('bill_phone') border-red-500 @enderror"
                                       placeholder="601234567890"
                                       value="{{ old('bill_phone', auth('customer')->user()->phone) }}"
                                       required>
                                @error('bill_phone')
                                    <span class="text-red-600 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="bill_email" class="block text-sm font-bold text-primary-900 mb-3 uppercase tracking-wide">
                                <i class="fas fa-envelope text-primary-600 mr-2"></i>Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="bill_email" id="bill_email"
                                   class="w-full px-5 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('bill_email') border-red-500 @enderror"
                                   placeholder="customer@example.com"
                                   value="{{ old('bill_email', auth('customer')->user()->email) }}"
                                   required>
                            @error('bill_email')
                                <span class="text-red-600 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="bill_address" class="block text-sm font-bold text-primary-900 mb-3 uppercase tracking-wide">
                                <i class="fas fa-map-pin text-primary-600 mr-2"></i>Address <span class="text-red-500">*</span>
                            </label>
                            <textarea name="bill_address" id="bill_address" rows="3"
                                      class="w-full px-5 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('bill_address') border-red-500 @enderror"
                                      placeholder="Enter your billing address"
                                      required>{{ old('bill_address', auth('customer')->user()->address) }}</textarea>
                            @error('bill_address')
                                <span class="text-red-600 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Receiver Information -->
                    <div class="bg-white rounded-2xl shadow-md border border-secondary-200 p-8">
                        <div class="flex items-center justify-between mb-6 pb-4 border-b-2 border-neutral-200">
                            <h2 class="text-2xl font-bold text-neutral-900">
                                <i class="fas fa-box text-primary-600 mr-2"></i>Receiver Information
                            </h2>
                            <label class="flex items-center gap-2 cursor-pointer text-sm font-semibold text-primary-700">
                                <input type="checkbox" id="same_as_billing" name="same_as_billing" class="w-5 h-5" onchange="toggleReceiverForm()">
                                <span>Same as Billing</span>
                            </label>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="recv_name" class="block text-sm font-bold text-primary-900 mb-3 uppercase tracking-wide">
                                    <i class="fas fa-user text-primary-600 mr-2"></i>Full Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="recv_name" id="recv_name"
                                       class="w-full px-5 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('recv_name') border-red-500 @enderror"
                                       placeholder="John Doe"
                                       value="{{ old('recv_name') }}"
                                       required>
                                @error('recv_name')
                                    <span class="text-red-600 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="recv_phone" class="block text-sm font-bold text-primary-900 mb-3 uppercase tracking-wide">
                                    <i class="fas fa-phone text-primary-600 mr-2"></i>Phone Number <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" name="recv_phone" id="recv_phone"
                                       class="w-full px-5 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('recv_phone') border-red-500 @enderror"
                                       placeholder="601234567890"
                                       value="{{ old('recv_phone') }}"
                                       required>
                                @error('recv_phone')
                                    <span class="text-red-600 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="recv_email" class="block text-sm font-bold text-primary-900 mb-3 uppercase tracking-wide">
                                <i class="fas fa-envelope text-primary-600 mr-2"></i>Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="recv_email" id="recv_email"
                                   class="w-full px-5 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('recv_email') border-red-500 @enderror"
                                   placeholder="customer@example.com"
                                   value="{{ old('recv_email') }}"
                                   required>
                            @error('recv_email')
                                <span class="text-red-600 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="recv_address" class="block text-sm font-bold text-primary-900 mb-3 uppercase tracking-wide">
                                <i class="fas fa-map-pin text-primary-600 mr-2"></i>Delivery Address <span class="text-red-500">*</span>
                            </label>
                            <textarea name="recv_address" id="recv_address" rows="3"
                                      class="w-full px-5 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition text-neutral-900 font-medium @error('recv_address') border-red-500 @enderror"
                                      placeholder="Enter delivery address"
                                      required>{{ old('recv_address') }}</textarea>
                            @error('recv_address')
                                <span class="text-red-600 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="bg-white rounded-2xl shadow-md border border-secondary-200 p-8">
                        <h2 class="text-2xl font-bold text-neutral-900 mb-6 pb-4 border-b-2 border-neutral-200">
                            <i class="fas fa-wallet text-primary-600 mr-2"></i>Payment Method
                        </h2>

                        <div class="space-y-4">
                            <!-- Credit/Debit Card -->
                            <label class="relative flex items-start p-6 border-2 border-neutral-300 rounded-lg cursor-pointer hover:border-primary-400 transition"
                                   onclick="document.getElementById('payment_card').checked = true">
                                <input type="radio" name="payment_method" id="payment_card" value="card" class="w-5 h-5 mt-1"
                                       {{ old('payment_method') == 'card' ? 'checked' : '' }}>
                                <div class="ml-4 flex-1">
                                    <p class="font-bold text-neutral-900">Credit/Debit Card</p>
                                    <p class="text-sm text-neutral-600 mt-1">Visa, Mastercard, and other major cards accepted</p>
                                </div>
                                <i class="fas fa-credit-card text-3xl text-neutral-400 ml-auto"></i>
                            </label>

                            <!-- TNG eWallet -->
                            <label class="relative flex items-start p-6 border-2 border-neutral-300 rounded-lg cursor-pointer hover:border-primary-400 transition"
                                   onclick="document.getElementById('payment_tng').checked = true">
                                <input type="radio" name="payment_method" id="payment_tng" value="tng" class="w-5 h-5 mt-1"
                                       {{ old('payment_method') == 'tng' ? 'checked' : '' }}>
                                <div class="ml-4 flex-1">
                                    <p class="font-bold text-neutral-900">TNG eWallet</p>
                                    <p class="text-sm text-neutral-600 mt-1">Fast and secure payment using your TNG card</p>
                                </div>
                                <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center ml-auto">
                                    <img src="{{ asset('storage/images/tng-logo.png') }}" alt="TNG Logo" class="w-8 h-8">
                                </div>
                            </label>

                            <!-- Shopee Pay -->
                            <label class="relative flex items-start p-6 border-2 border-neutral-300 rounded-lg cursor-pointer hover:border-primary-400 transition"
                                   onclick="document.getElementById('payment_shopee').checked = true">
                                <input type="radio" name="payment_method" id="payment_shopee" value="shopee" class="w-5 h-5 mt-1"
                                       {{ old('payment_method') == 'shopee' ? 'checked' : '' }}>
                                <div class="ml-4 flex-1">
                                    <p class="font-bold text-neutral-900">Shopee Pay</p>
                                    <p class="text-sm text-neutral-600 mt-1">Pay using your Shopee credits and wallet balance</p>
                                </div>
                                <div class="w-12 h-12 rounded-lg bg-orange-100 flex items-center justify-center ml-auto">
                                    <img src="{{ asset('storage/images/shopee-logo.png') }}" alt="Shopee Pay Logo" class="w-8 h-8">
                                </div>
                            </label>

                            <!-- Grab Pay -->
                            <label class="relative flex items-start p-6 border-2 border-neutral-300 rounded-lg cursor-pointer hover:border-primary-400 transition"
                                   onclick="document.getElementById('payment_grab').checked = true">
                                <input type="radio" name="payment_method" id="payment_grab" value="grab" class="w-5 h-5 mt-1"
                                       {{ old('payment_method') == 'grab' ? 'checked' : '' }}>
                                <div class="ml-4 flex-1">
                                    <p class="font-bold text-neutral-900">Grab Pay</p>
                                    <p class="text-sm text-neutral-600 mt-1">Easy payments with your Grab account and wallet</p>
                                </div>
                                <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center ml-auto">
                                    <img src="{{ asset('storage/images/grab-logo.png') }}" alt="Grab Pay Logo" class="w-8 h-8">
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="bg-blue-50 rounded-lg p-6 border-l-4 border-blue-500">
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" name="agree_terms" class="mt-1 w-5 h-5 text-primary-600 rounded focus:ring-2 focus:ring-primary-500" required>
                            <span class="text-sm text-neutral-700">
                                I agree to the <a href="#" class="text-primary-700 hover:text-primary-800 font-semibold">Terms & Conditions</a> and <a href="#" class="text-primary-700 hover:text-primary-800 font-semibold">Privacy Policy</a>
                            </span>
                        </label>
                    </div>
                </div>

                <!-- Order Summary Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-md border border-secondary-200 p-8 sticky top-4">
                        <h3 class="text-xl font-bold text-neutral-900 mb-6 pb-4 border-b-2 border-neutral-200">
                            <i class="fas fa-receipt text-primary-600 mr-2"></i>Order Summary
                        </h3>

                        <!-- Cart Items -->
                        <div class="mb-6 max-h-64 overflow-y-auto">
                            @forelse($items as $line)
                                <div class="flex items-start gap-3 pb-3 mb-3 border-b border-neutral-200">
                                    <div class="w-12 h-12 rounded-lg bg-neutral-100 flex-shrink-0 overflow-hidden">
                                        @if($line['product']->image_path)
                                            <img src="{{ asset('storage/' . $line['product']->image_path) }}" alt="{{ $line['product']->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-neutral-400">
                                                <i class="fas fa-box text-sm"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs font-semibold text-neutral-900 line-clamp-2">{{ $line['product']->name }}</p>
                                        <p class="text-xs text-neutral-600 mt-1">{{ $line['quantity'] }}x RM {{ number_format($line['unit_price'], 2) }}</p>
                                    </div>
                                    <p class="text-sm font-bold text-neutral-900 flex-shrink-0">RM {{ number_format($line['total'], 2) }}</p>
                                </div>
                            @empty
                                <p class="text-neutral-600 text-sm text-center py-4">No items in cart</p>
                            @endforelse
                        </div>

                        <!-- Total -->
                        <div class="space-y-3 mb-6 pt-4 border-t-2 border-neutral-200">
                            <div class="flex items-center justify-between">
                                <span class="text-neutral-700">Subtotal</span>
                                <span class="font-semibold text-neutral-900">RM {{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-neutral-700">Shipping</span>
                                <span class="text-xs text-neutral-500">(By artisan)</span>
                            </div>
                            <div class="flex items-center justify-between pt-3 border-t border-neutral-200">
                                <span class="text-lg font-bold text-neutral-900">Total</span>
                                <span class="text-2xl font-bold text-primary-700">RM {{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-6 py-4 rounded-lg bg-gradient-to-r from-primary-600 to-primary-700 text-white font-bold shadow-lg hover:shadow-xl transition transform hover:scale-105 duration-300 uppercase tracking-wide">
                            <i class="fas fa-lock text-lg"></i>
                            <span>Complete Payment</span>
                        </button>

                        <!-- Back Button -->
                        <a href="{{ route('cart.index') }}" class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg border-2 border-neutral-300 text-neutral-700 font-bold hover:bg-neutral-50 transition mt-3">
                            <i class="fas fa-arrow-left"></i>
                            <span>Back to Cart</span>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function toggleReceiverForm() {
    const sameAsBilling = document.getElementById('same_as_billing').checked;
    const recvName = document.getElementById('recv_name');
    const recvPhone = document.getElementById('recv_phone');
    const recvEmail = document.getElementById('recv_email');
    const recvAddress = document.getElementById('recv_address');

    if (sameAsBilling) {
        const billName = document.getElementById('bill_name').value;
        const billPhone = document.getElementById('bill_phone').value;
        const billEmail = document.getElementById('bill_email').value;
        const billAddress = document.getElementById('bill_address').value;

        recvName.value = billName;
        recvPhone.value = billPhone;
        recvEmail.value = billEmail;
        recvAddress.value = billAddress;

        // Disable receiver fields visually
        recvName.disabled = true;
        recvPhone.disabled = true;
        recvEmail.disabled = true;
        recvAddress.disabled = true;

        // Fade out effect
        recvName.parentElement.parentElement.classList.add('opacity-50');
        recvPhone.parentElement.parentElement.classList.add('opacity-50');
        recvEmail.parentElement.parentElement.classList.add('opacity-50');
        recvAddress.parentElement.parentElement.classList.add('opacity-50');
    } else {
        // Enable receiver fields
        recvName.disabled = false;
        recvPhone.disabled = false;
        recvEmail.disabled = false;
        recvAddress.disabled = false;

        // Remove fade effect
        recvName.parentElement.parentElement.classList.remove('opacity-50');
        recvPhone.parentElement.parentElement.classList.remove('opacity-50');
        recvEmail.parentElement.parentElement.classList.remove('opacity-50');
        recvAddress.parentElement.parentElement.classList.remove('opacity-50');
    }
}

// Enable all disabled receiver fields before form submission
function enableReceiverFieldsBeforeSubmit() {
    const recvName = document.getElementById('recv_name');
    const recvPhone = document.getElementById('recv_phone');
    const recvEmail = document.getElementById('recv_email');
    const recvAddress = document.getElementById('recv_address');

    recvName.disabled = false;
    recvPhone.disabled = false;
    recvEmail.disabled = false;
    recvAddress.disabled = false;
}
</script>
@endsection
