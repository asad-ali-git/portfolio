<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'github_url'  => ['nullable', 'url', 'max:255'],
            'live_url'    => ['nullable', 'url', 'max:255'],
            'tech_stack'  => ['nullable', 'array'],
            'tech_stack.*'=> ['string', 'max:100'],
            'is_featured' => ['boolean'],
            'sort_order'  => ['integer', 'min:0'],
        ];
    }
}
