<?php

namespace App\Http\Requests;

use App\Models\Skill;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSkillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'       => ['sometimes', 'string', 'max:100'],
            'category'   => ['sometimes', Rule::in(Skill::categories())],
            'level'      => ['sometimes', 'integer', 'min:1', 'max:100'],
            'sort_order' => ['integer', 'min:0'],
        ];
    }
}
