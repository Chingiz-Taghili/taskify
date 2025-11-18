<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'client_id' => ['sometimes', 'nullable', 'integer', 'exists:clients,id'],
            'project_id' => ['sometimes', 'nullable', 'integer', 'exists:projects,id'],
            'category_id' => ['sometimes', 'nullable', 'integer', 'exists:categories,id'],
            'title' => ['sometimes', 'string', 'min:2', 'max:160'],
            'description' => ['sometimes', 'nullable', 'string', 'min:2'],
            'parent_task_id' => ['sometimes', 'nullable', 'integer', 'exists:tasks,id'],
            'due_date' => ['sometimes', 'nullable', 'date'],
        ];
    }
}
