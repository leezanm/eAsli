@extends('layouts.app')

@section('title', 'Tambah/Edit Jualan')

@section('content')
<div class="page-header">
    <div class="container">
        <h1>{{ isset($sale) ? 'Edit Jualan' : 'Rekod Jualan Baru' }}</h1>
    </div>
</div>

<div class="container py-4">
    <div class="mb-4">
        <a href="{{ route('sales.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body p-4">
                    <form method="POST" action="{{ isset($sale) ? route('sales.update', $sale) : route('sales.store') }}">
                        @csrf
                        @if(isset($sale)) @method('PUT') @endif

                        <div class="mb-3">
                            <label for="product_id" class="form-label">Produk *</label>
                            <select class="form-select @error('product_id') is-invalid @enderror"
                                id="product_id" name="product_id" required onchange="updatePrice()">
                                <option value="">Pilih Produk</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}"
                                        data-price="{{ $product->price }}"
                                        data-stock="{{ $product->stock }}"
                                        {{ (old('product_id', $sale->product_id ?? '') == $product->id) ? 'selected' : '' }}>
                                        {{ $product->name }} - RM {{ number_format($product->price, 2) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="customer_id" class="form-label">Pelanggan *</label>
                            <select class="form-select @error('customer_id') is-invalid @enderror"
                                id="customer_id" name="customer_id" required>
                                <option value="">Pilih Pelanggan</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        {{ (old('customer_id', $sale->customer_id ?? '') == $customer->id) ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Kuantiti *</label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                id="quantity" name="quantity" value="{{ old('quantity', $sale->quantity ?? 1) }}"
                                min="1" required onchange="updatePrice()">
                            <small class="text-muted" id="stockInfo"></small>
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price_per_unit" class="form-label">Harga Setiap Unit (RM)</label>
                            <input type="number" step="0.01" class="form-control"
                                id="price_per_unit" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="total_price" class="form-label">Jumlah Harga (RM)</label>
                            <input type="number" step="0.01" class="form-control"
                                id="total_price" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status *</label>
                            <select class="form-select @error('status') is-invalid @enderror"
                                id="status" name="status" required>
                                <option value="completed" {{ (old('status', $sale->status ?? '') === 'completed') ? 'selected' : '' }}>Selesai</option>
                                <option value="pending" {{ (old('status', $sale->status ?? '') === 'pending') ? 'selected' : '' }}>Tertangguh</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save"></i> {{ isset($sale) ? 'Kemaskini' : 'Rekod' }}
                            </button>
                            <a href="{{ route('sales.index') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updatePrice() {
    const select = document.getElementById('product_id');
    const quantity = parseFloat(document.getElementById('quantity').value) || 1;
    const option = select.options[select.selectedIndex];

    if (option.value) {
        const price = parseFloat(option.dataset.price);
        const stock = parseInt(option.dataset.stock);

        document.getElementById('price_per_unit').value = price.toFixed(2);
        document.getElementById('total_price').value = (price * quantity).toFixed(2);
        document.getElementById('stockInfo').textContent = `Stok tersedia: ${stock} unit`;
    }
}

document.addEventListener('DOMContentLoaded', updatePrice);
</script>
@endsection
