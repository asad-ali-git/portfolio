<?php

namespace App\Http\Requests;

use App\Models\Skill;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSkillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'       => ['required', 'string', 'max:100'],
            'category'   => ['required', Rule::in(Skill::categories())],
            'level'      => ['required', 'integer', 'min:1', 'max:100'],
            'sort_order' => ['integer', 'min:0'],
        ];
    }
}
