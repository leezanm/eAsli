<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Customer extends Model implements Authenticatable
{
    use AuthenticableTrait;
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'city',
        'postal_code',
    ];

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function getTotalSpent()
    {
        return $this->sales()->sum('total_price');
    }

    public function getTotalOrders()
    {
        return $this->sales()->count();
    }
}
