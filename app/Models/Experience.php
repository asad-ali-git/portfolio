<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'company',
        'role',
        'start_date',
        'end_date',
        'description',
        'sort_order',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
        'sort_order' => 'integer',
    ];

    /**
     * Whether this is the current position
     */
    public function isCurrentPosition(): bool
    {
        return is_null($this->end_date);
    }

    /**
     * Scope: ordered by most recent first
     */
    public function scopeOrdered($query)
    {
        return $query->orderByDesc('start_date');
    }
}
