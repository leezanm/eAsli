@extends('layouts.app')

@section('title', 'Order Confirmation')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-50 via-secondary-50 to-neutral-0 py-10 px-4">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-green-500 to-emerald-600 text-white shadow-lg mb-4 animate-pulse">
                <i class="fas fa-check-circle text-2xl"></i>
            </div>
            <h1 class="text-4xl font-bold text-neutral-900 mb-2">Order Confirmed!</h1>
            <p class="text-neutral-600 text-lg">Thank you for your purchase. Here are your order details.</p>
        </div>

        <!-- Order Details Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden mb-6">
            <!-- Header -->
            <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white p-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-primary-100 uppercase tracking-wide mb-1">Order ID</p>
                        <p class="text-3xl font-bold">#{{ $sale->id }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-semibold text-primary-100 uppercase tracking-wide mb-1">Order Date</p>
                        <p class="text-2xl font-bold">{{ \Carbon\Carbon::parse($sale->sale_date)->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8">
                <!-- Product Info -->
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-neutral-900 mb-6 pb-4 border-b-2 border-neutral-200">
                        <i class="fas fa-box text-primary-600 mr-2"></i>Items in Order
                    </h2>

                    @foreach($allSales as $item)
                    <div class="mb-8 pb-8 border-b-2 border-neutral-200 last:border-b-0">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                            <!-- Product Image -->
                            <div class="md:col-span-1">
                                <div class="rounded-lg overflow-hidden bg-neutral-100 h-48">
                                    @if($item->product->image_path)
                                        <img src="{{ asset('storage/' . $item->product->image_path) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <i class="fas fa-box text-neutral-400 text-4xl"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Product Details -->
                            <div class="md:col-span-3">
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-xs text-neutral-600 uppercase tracking-wide font-semibold mb-1">Product Name</p>
                                        <h3 class="text-2xl font-bold text-neutral-900">{{ $item->product->name }}</h3>
                                    </div>

                                    <div>
                                        <p class="text-xs text-neutral-600 uppercase tracking-wide font-semibold mb-1">Category</p>
                                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-primary-50 text-primary-700">
                                            {{ ucfirst($item->product->category) }}
                                        </span>
                                    </div>

                                    @if($item->product->description)
                                    <div>
                                        <p class="text-xs text-neutral-600 uppercase tracking-wide font-semibold mb-1">Description</p>
                                        <p class="text-neutral-700">{{ Str::limit($item->product->description, 200) }}</p>
                                    </div>
                                    @endif

                                    <div class="flex gap-4 pt-2">
                                        <div>
                                            <p class="text-xs text-neutral-600 uppercase tracking-wide font-semibold mb-1">Unit Price</p>
                                            <p class="text-lg font-bold text-neutral-900">RM {{ number_format($item->unit_price, 2) }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-neutral-600 uppercase tracking-wide font-semibold mb-1">Quantity</p>
                                            <p class="text-lg font-bold text-neutral-900">{{ $item->quantity }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-neutral-600 uppercase tracking-wide font-semibold mb-1">Subtotal</p>
                                            <p class="text-lg font-bold text-primary-700">RM {{ number_format($item->total_price, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Order Summary -->
                <div class="mb-8 pb-8 border-b-2 border-neutral-200">
                    <h2 class="text-lg font-bold text-neutral-900 mb-6">
                        <i class="fas fa-receipt text-primary-600 mr-2"></i>Order Summary
                    </h2>

                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-neutral-700">Number of Items</span>
                            <span class="font-semibold text-neutral-900">{{ $allSales->count() }} item(s)</span>
                        </div>
                        <div class="flex items-center justify-between pt-3 border-t-2 border-neutral-200">
                            <span class="text-lg font-bold text-neutral-900">Total Order Amount</span>
                            <span class="text-2xl font-bold text-primary-700">RM {{ number_format($orderTotal, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Artisan Info -->
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-neutral-900 mb-6">
                        <i class="fas fa-user-circle text-primary-600 mr-2"></i>Sold By
                    </h2>

                    <div class="bg-gradient-to-br from-primary-50 to-secondary-50 rounded-lg p-6 border-l-4 border-primary-500">
                        <p class="text-sm text-neutral-600 uppercase tracking-wide font-semibold mb-2">Artisan Name</p>
                        <h3 class="text-xl font-bold text-neutral-900 mb-3">{{ $sale->artisan->name }}</h3>

                        @if($sale->artisan->shops()->first())
                            <div class="text-sm text-neutral-700 space-y-2">
                                <div class="flex items-start gap-2">
                                    <i class="fas fa-map-marker-alt text-primary-600 mt-1"></i>
                                    <span>{{ $sale->artisan->shops()->first()->address ?? 'Address not available' }}</span>
                                </div>
                                @if($sale->artisan->shops()->first()->phone)
                                <div class="flex items-start gap-2">
                                    <i class="fas fa-phone text-primary-600 mt-1"></i>
                                    <span>{{ $sale->artisan->shops()->first()->phone }}</span>
                                </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Payment Status -->
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg p-6 border-l-4 border-green-500 mb-8">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                            <i class="fas fa-check text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-neutral-600 uppercase tracking-wide font-semibold">Payment Status</p>
                            <p class="text-lg font-bold text-green-700">{{ ucfirst($sale->payment_status) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                @if($sale->payment_method)
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-neutral-900 mb-6 pb-4 border-b-2 border-neutral-200">
                        <i class="fas fa-wallet text-primary-600 mr-2"></i>Payment Method
                    </h2>
                    <div class="bg-neutral-50 rounded-lg p-6">
                        <div class="flex items-center gap-4">
                            @if($sale->payment_method === 'card')
                                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                                    <i class="fas fa-credit-card text-blue-600 text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-neutral-600 uppercase tracking-wide font-semibold">Credit/Debit Card</p>
                                    <p class="text-neutral-900 font-semibold">Visa, Mastercard, or other major card</p>
                                </div>
                            @elseif($sale->payment_method === 'tng')
                                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                                    <span class="font-bold text-blue-600 text-sm">TNG</span>
                                </div>
                                <div>
                                    <p class="text-sm text-neutral-600 uppercase tracking-wide font-semibold">TNG eWallet</p>
                                    <p class="text-neutral-900 font-semibold">Payment via TNG eWallet</p>
                                </div>
                            @elseif($sale->payment_method === 'shopee')
                                <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center">
                                    <i class="fas fa-shopping-bag text-orange-600 text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-neutral-600 uppercase tracking-wide font-semibold">Shopee Pay</p>
                                    <p class="text-neutral-900 font-semibold">Payment via Shopee Pay</p>
                                </div>
                            @elseif($sale->payment_method === 'grab')
                                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                                    <i class="fas fa-car text-green-600 text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-neutral-600 uppercase tracking-wide font-semibold">Grab Pay</p>
                                    <p class="text-neutral-900 font-semibold">Payment via Grab Pay</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                <!-- Billing Information -->
                @if($sale->billing_name)
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-neutral-900 mb-6 pb-4 border-b-2 border-neutral-200">
                        <i class="fas fa-map-marker-alt text-primary-600 mr-2"></i>Billing Information
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-neutral-600 uppercase tracking-wide font-semibold mb-2">Name</p>
                            <p class="text-neutral-900 font-semibold">{{ $sale->billing_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-neutral-600 uppercase tracking-wide font-semibold mb-2">Email</p>
                            <p class="text-neutral-900 font-semibold">{{ $sale->billing_email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-neutral-600 uppercase tracking-wide font-semibold mb-2">Phone</p>
                            <p class="text-neutral-900 font-semibold">{{ $sale->billing_phone }}</p>
                        </div>
                        <div></div>
                        <div class="md:col-span-2">
                            <p class="text-sm text-neutral-600 uppercase tracking-wide font-semibold mb-2">Billing Address</p>
                            <p class="text-neutral-900 font-semibold">{{ $sale->billing_address }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Receiver Information -->
                @if($sale->receiver_name)
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-neutral-900 mb-6 pb-4 border-b-2 border-neutral-200">
                        <i class="fas fa-box text-primary-600 mr-2"></i>Delivery Information
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-neutral-600 uppercase tracking-wide font-semibold mb-2">Recipient Name</p>
                            <p class="text-neutral-900 font-semibold">{{ $sale->receiver_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-neutral-600 uppercase tracking-wide font-semibold mb-2">Email</p>
                            <p class="text-neutral-900 font-semibold">{{ $sale->receiver_email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-neutral-600 uppercase tracking-wide font-semibold mb-2">Phone</p>
                            <p class="text-neutral-900 font-semibold">{{ $sale->receiver_phone }}</p>
                        </div>
                        <div></div>
                        <div class="md:col-span-2">
                            <p class="text-sm text-neutral-600 uppercase tracking-wide font-semibold mb-2">Delivery Address</p>
                            <p class="text-neutral-900 font-semibold">{{ $sale->receiver_address }}</p>
                        </div>
                    </div>
                </div>
                @else
                <!-- Customer Info (Fallback) -->
                <div class="mb-8 pb-8 border-b-2 border-neutral-200">
                    <h2 class="text-lg font-bold text-neutral-900 mb-6">
                        <i class="fas fa-user text-primary-600 mr-2"></i>Delivery Information
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-neutral-600 uppercase tracking-wide font-semibold mb-2">Name</p>
                            <p class="text-neutral-900 font-semibold">{{ $customer->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-neutral-600 uppercase tracking-wide font-semibold mb-2">Email</p>
                            <p class="text-neutral-900 font-semibold">{{ $customer->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-neutral-600 uppercase tracking-wide font-semibold mb-2">Phone</p>
                            <p class="text-neutral-900 font-semibold">{{ $customer->phone }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-neutral-600 uppercase tracking-wide font-semibold mb-2">Delivery Address</p>
                            <p class="text-neutral-900 font-semibold">{{ $customer->address ?? 'Not provided' }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Next Steps -->
                <div class="bg-blue-50 rounded-lg p-6 border-l-4 border-blue-500">
                    <h3 class="font-bold text-neutral-900 mb-3 flex items-center gap-2">
                        <i class="fas fa-info-circle text-blue-600"></i>
                        What Happens Next?
                    </h3>
                    <ul class="text-sm text-neutral-700 space-y-2">
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-green-600 mt-1"></i>
                            <span>Your order will be confirmed with the artisan immediately</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-green-600 mt-1"></i>
                            <span>The artisan will prepare your item for shipping</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-green-600 mt-1"></i>
                            <span>You'll receive updates about your order status</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-green-600 mt-1"></i>
                            <span>Your item will be delivered to your address</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4">
            <a href="{{ route('home') }}" class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg bg-gradient-to-r from-primary-600 to-primary-700 text-white font-bold shadow-lg hover:shadow-xl transition transform hover:scale-105">
                <i class="fas fa-home"></i>
                <span>Back to Home</span>
            </a>
            <a href="{{ route('customers.history', $customer->id) }}" class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg border-2 border-primary-600 text-primary-700 font-bold hover:bg-primary-50 transition">
                <i class="fas fa-history"></i>
                <span>View Order History</span>
            </a>
            <a href="{{ route('products.shop') }}" class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg bg-gradient-to-r from-accent-500 to-accent-600 text-white font-bold shadow-lg hover:shadow-xl transition transform hover:scale-105">
                <i class="fas fa-shopping-bag"></i>
                <span>Continue Shopping</span>
            </a>
        </div>
    </div>
</div>
@endsection
