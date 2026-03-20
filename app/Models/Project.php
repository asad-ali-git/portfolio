<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'github_url',
        'live_url',
        'tech_stack',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'tech_stack'  => 'array',
        'is_featured' => 'boolean',
        'sort_order'  => 'integer',
    ];

    /**
     * Scope: only featured projects
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope: order by sort_order then latest
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->latest();
    }
}
