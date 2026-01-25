@extends('layouts.app')

@section('title', 'Record Sale')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-neutral-100 to-neutral-50 py-10">
    <div class="max-w-4xl mx-auto px-4">
        <div class="bg-neutral-0 rounded-2xl shadow-2xl overflow-hidden border border-neutral-100">
            <!-- Header -->
            <div class="bg-gradient-to-r from-primary-700 to-primary-800 text-white p-8 md:p-10 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="inline-flex items-center justify-center w-11 h-11 rounded-full bg-primary-600/70 text-white text-xl">
                            <i class="fas fa-receipt"></i>
                        </span>
                        <h1 class="text-3xl font-bold">Record New Sale</h1>
                    </div>
                    <p class="text-primary-100 text-sm md:text-base">
                        Capture a new sale for your products and update stock automatically.
                    </p>
                </div>
                <div class="flex gap-2 flex-wrap justify-end">
                    <a href="{{ route('sales.index') }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-white/10 hover:bg-white/20 text-sm font-semibold">
                        <i class="fas fa-list mr-2"></i>
                        Back to Sales
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

                <form method="POST" action="{{ route('sales.store') }}">
                    @csrf

                    @if(auth('artisan')->check())
                        <input type="hidden" name="artisan_id" value="{{ auth('artisan')->id() }}">
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="product_id" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                                <i class="fas fa-box text-primary-600 mr-2"></i>Product *
                            </label>
                            <select id="product_id" name="product_id" required onchange="updatePrice()"
                                    class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none text-neutral-900 text-sm @error('product_id') border-red-500 @enderror">
                                <option value="">Select a product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}"
                                        data-price="{{ $product->price }}"
                                        data-stock="{{ $product->stock }}"
                                        {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }} - RM {{ number_format($product->price, 2) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <span class="text-red-600 text-sm mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div>
                            <label for="customer_id" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                                <i class="fas fa-user text-primary-600 mr-2"></i>Customer *
                            </label>
                            <select id="customer_id" name="customer_id" required
                                    class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none text-neutral-900 text-sm @error('customer_id') border-red-500 @enderror">
                                <option value="">Select a customer</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <span class="text-red-600 text-sm mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="quantity" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                                <i class="fas fa-boxes-stacked text-primary-600 mr-2"></i>Quantity *
                            </label>
                            <input type="number" id="quantity" name="quantity" min="1" required onchange="updatePrice()"
                                   value="{{ old('quantity', 1) }}"
                                   class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none text-neutral-900 font-medium @error('quantity') border-red-500 @enderror">
                            <p id="stockInfo" class="mt-1 text-xs text-neutral-500"></p>
                            @error('quantity')
                                <span class="text-red-600 text-sm mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div>
                            <label for="sale_date" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                                <i class="fas fa-calendar-day text-primary-600 mr-2"></i>Sale Date *
                            </label>
                            <input type="date" id="sale_date" name="sale_date" required
                                   value="{{ old('sale_date', now()->toDateString()) }}"
                                   class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none text-neutral-900 text-sm @error('sale_date') border-red-500 @enderror">
                            @error('sale_date')
                                <span class="text-red-600 text-sm mt-1 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="price_per_unit" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                                <i class="fas fa-tag text-primary-600 mr-2"></i>Unit Price (RM)
                            </label>
                            <input type="number" step="0.01" id="price_per_unit" readonly
                                   class="w-full px-4 py-3 border-2 border-neutral-200 rounded-lg bg-neutral-50 text-neutral-700">
                        </div>

                        <div>
                            <label for="total_price" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                                <i class="fas fa-coins text-primary-600 mr-2"></i>Total Amount (RM)
                            </label>
                            <input type="number" step="0.01" id="total_price" readonly
                                   class="w-full px-4 py-3 border-2 border-neutral-200 rounded-lg bg-neutral-50 text-neutral-800 font-semibold">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="payment_status" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                            <i class="fas fa-wallet text-primary-600 mr-2"></i>Payment Status *
                        </label>
                        @php($currentStatus = old('payment_status', 'pending'))
                        <select id="payment_status" name="payment_status" required
                                class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none text-neutral-900 text-sm @error('payment_status') border-red-500 @enderror">
                            <option value="pending" {{ $currentStatus === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $currentStatus === 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="failed" {{ $currentStatus === 'failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                        @error('payment_status')
                            <span class="text-red-600 text-sm mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="mb-8">
                        <label for="notes" class="block text-sm font-bold text-primary-900 mb-2 uppercase tracking-wide">
                            <i class="fas fa-sticky-note text-primary-600 mr-2"></i>Notes (optional)
                        </label>
                        <textarea id="notes" name="notes" rows="3"
                                  class="w-full px-4 py-3 border-2 border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none text-neutral-900 text-sm @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
                        @error('notes')
                            <span class="text-red-600 text-sm mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="flex flex-col md:flex-row gap-4 mb-2">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105 duration-300 uppercase tracking-wide text-center">
                            <i class="fas fa-save mr-2"></i>Record Sale
                        </button>
                        <a href="{{ route('sales.index') }}" class="flex-1 bg-neutral-300 hover:bg-neutral-400 text-neutral-800 font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105 duration-300 uppercase tracking-wide text-center">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function updatePrice() {
    const select = document.getElementById('product_id');
    const quantityInput = document.getElementById('quantity');
    const quantity = parseFloat(quantityInput.value) || 1;
    const option = select.options[select.selectedIndex];

    if (option && option.value) {
        const price = parseFloat(option.dataset.price || 0);
        const stock = parseInt(option.dataset.stock || 0);

        document.getElementById('price_per_unit').value = price.toFixed(2);
        document.getElementById('total_price').value = (price * quantity).toFixed(2);
        document.getElementById('stockInfo').textContent = `Available stock: ${stock} units`;
    } else {
        document.getElementById('price_per_unit').value = '';
        document.getElementById('total_price').value = '';
        document.getElementById('stockInfo').textContent = '';
    }
}

document.addEventListener('DOMContentLoaded', updatePrice);
</script>
@endsection
