<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'min:2', 'max:100',
                Rule::unique('projects')->ignore($this->route('project')),],
            'client_id' => ['sometimes', 'nullable', 'integer', Rule::exists('clients', 'id')],
            'description' => ['sometimes', 'nullable', 'string', 'min:2'],
            'cover_photo' => ['sometimes', 'nullable', 'string', 'max:255', 'regex:/\.(jpg|jpeg|png|webp)$/i'],
            'due_date' => ['sometimes', 'nullable', 'date'],
        ];
    }
}
