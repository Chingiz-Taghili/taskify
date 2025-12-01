<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'client_id' => ['nullable', 'integer', Rule::exists('clients', 'id')],
            'project_id' => ['nullable', 'integer', Rule::exists('projects', 'id')],
            'category_id' => ['nullable', 'integer', Rule::exists('categories', 'id')],
            'title' => ['required', 'string', 'min:2', 'max:160'],
            'description' => ['nullable', 'string', 'min:2'],
            'parent_task_id' => ['nullable', 'integer', Rule::exists('tasks', 'id')],
            'due_date' => ['nullable', 'date'],
        ];
    }
}
