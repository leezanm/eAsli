<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'artisan_id',
        'name',
        'description',
        'category',
        'price',
        'stock',
        'image_path',
        'status',
    ];

    public function artisan(): BelongsTo
    {
        return $this->belongsTo(Artisan::class);
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function decreaseStock($quantity): void
    {
        $this->decrement('stock', $quantity);
    }

    public function increaseStock($quantity): void
    {
        $this->increment('stock', $quantity);
    }
}
