<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:100', Rule::unique('projects')],
            'client_id' => ['nullable', 'integer', 'exists:clients,id'],
            'description' => ['nullable', 'string', 'min:2'],
            'cover_photo' => ['nullable', 'string', 'max:255', 'regex:/\.(jpg|jpeg|png|webp)$/i'],
        ];
    }
}
