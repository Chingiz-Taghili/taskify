<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'min:2', 'max:100',
                Rule::unique('categories')->ignore($this->route('category')),],
            'description' => ['sometimes', 'nullable', 'string', 'min:2'],
        ];
    }
}
