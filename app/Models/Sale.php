<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    protected $fillable = [
        'artisan_id',
        'product_id',
        'customer_id',
        'quantity',
        'unit_price',
        'total_price',
        'sale_date',
        'payment_status',
        'notes',
    ];

    protected $casts = [
        'sale_date' => 'date',
    ];

    public function artisan(): BelongsTo
    {
        return $this->belongsTo(Artisan::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function calculateTotalPrice(): float
    {
        return $this->unit_price * $this->quantity;
    }
}
