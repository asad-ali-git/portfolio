<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            // Identity
            'name'                => $this->name,
            'first_name'          => $this->first_name,
            'last_name'           => $this->last_name,
            'title'               => $this->title,
            'subtitle'            => $this->subtitle,
            'tagline'             => $this->tagline,

            // About
            'bio'                 => $this->bio_paragraphs,   // array of strings
            'tags'                => $this->tags ?? [],

            // Contact & presence
            'location'            => $this->location,
            'availability'        => $this->availability,
            'email'               => $this->email,
            'github_url'          => $this->github_url,
            'linkedin_url'        => $this->linkedin_url,
            'resume_url'          => $this->resume_url,

            // Stats
            'years_of_experience' => $this->years_of_experience,
            'open_source_commits' => $this->open_source_commits,
        ];
    }
}
