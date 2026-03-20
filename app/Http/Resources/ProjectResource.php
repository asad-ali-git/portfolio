<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'image'       => $this->image ? asset('storage/' . $this->image) : null,
            'github_url'  => $this->github_url,
            'live_url'    => $this->live_url,
            'tech_stack'  => $this->tech_stack ?? [],
            'is_featured' => $this->is_featured,
            'sort_order'  => $this->sort_order,
            'created_at'  => $this->created_at?->toDateString(),
        ];
    }
}
