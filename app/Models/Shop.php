<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shop extends Model
{
    protected $fillable = [
        'artisan_id',
        'name',
        'address',
        'state',
        'latitude',
        'longitude',
        'status',
        'phone',
        'description',
    ];

    public function artisan(): BelongsTo
    {
        return $this->belongsTo(Artisan::class);
    }

    public function products(): HasMany
    {
        // Products are linked to the same artisan that owns this shop
        return $this->hasMany(Product::class, 'artisan_id', 'artisan_id');
    }
}
