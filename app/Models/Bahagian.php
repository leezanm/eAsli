<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bahagian extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
