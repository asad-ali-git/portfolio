<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExperienceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company'     => ['sometimes', 'string', 'max:255'],
            'role'        => ['sometimes', 'string', 'max:255'],
            'start_date'  => ['sometimes', 'date'],
            'end_date'    => ['nullable', 'date'],
            'description' => ['sometimes', 'string'],
            'sort_order'  => ['integer', 'min:0'],
        ];
    }
}
