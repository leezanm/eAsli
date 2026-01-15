<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Artisan extends Model implements Authenticatable
{
    use AuthenticableTrait;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'description',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    public function shops(): HasMany
    {
        return $this->hasMany(Shop::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }
}
