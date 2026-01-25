<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    protected $fillable = [
        'artisan_id',
        'type',
        'report_type',
        'start_date',
        'end_date',
        'content',
        'file_path',
        'format',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function artisan(): BelongsTo
    {
        return $this->belongsTo(Artisan::class);
    }

    public function isExpired(): bool
    {
        return now()->diffInDays($this->created_at) > 30;
    }
}
