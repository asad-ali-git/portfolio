<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'level',
        'sort_order',
    ];

    protected $casts = [
        'level'      => 'integer',
        'sort_order' => 'integer',
    ];

    /**
     * Available skill categories
     */
    public static function categories(): array
    {
        return ['Frontend', 'Backend', 'Tools', 'Database'];
    }

    /**
     * Scope: order by sort_order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}
