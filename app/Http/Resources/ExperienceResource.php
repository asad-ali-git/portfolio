<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExperienceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'company'     => $this->company,
            'role'        => $this->role,
            'start_date'  => $this->start_date?->format('M Y'),
            'end_date'    => $this->end_date?->format('M Y'),
            'is_current'  => $this->isCurrentPosition(),
            'description' => $this->description,
            'sort_order'  => $this->sort_order,
        ];
    }
}
