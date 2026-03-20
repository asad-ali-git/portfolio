<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExperienceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company'     => ['required', 'string', 'max:255'],
            'role'        => ['required', 'string', 'max:255'],
            'start_date'  => ['required', 'date'],
            'end_date'    => ['nullable', 'date', 'after:start_date'],
            'description' => ['required', 'string'],
            'sort_order'  => ['integer', 'min:0'],
        ];
    }
}
