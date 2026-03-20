<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Profile extends Model
{
    protected $table = 'profile';

    protected $fillable = [
        'name',
        'title',
        'subtitle',
        'tagline',
        'bio',
        'tags',
        'location',
        'availability',
        'email',
        'github_url',
        'linkedin_url',
        'resume_url',
        'years_of_experience',
        'open_source_commits',
    ];

    protected $casts = [
        'tags'                => 'array',
        'years_of_experience' => 'integer',
        'open_source_commits' => 'integer',
    ];

    /**
     * Return the single profile row, creating a blank one if absent.
     */
    public static function instance(): static
    {
        return static::firstOrCreate(['id' => 1]);
    }

    /**
     * Bio stored as paragraphs separated by blank lines.
     * Returns them as an ordered array of strings.
     */
    public function getBioParagraphsAttribute(): array
    {
        return array_values(
            array_filter(
                array_map('trim', explode("\n\n", $this->bio ?? ''))
            )
        );
    }

    /** First word of the full name (for hero heading). */
    public function getFirstNameAttribute(): string
    {
        return Str::before($this->name, ' ');
    }

    /** Everything after the first space (for grad-text line). */
    public function getLastNameAttribute(): string
    {
        return Str::after($this->name, ' ');
    }
}
