<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserFilterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'page' => ['nullable', 'integer', 'min:1'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
            'sort_by' => ['nullable', Rule::in(['id', 'name', 'surname', 'email',
                'email_verified_at', 'job_title', 'phone_number', 'created_at', 'updated_at'])],
            'sort_order' => ['nullable', Rule::in(['asc', 'desc'])],
            'role' => ['nullable', 'string', Rule::exists('roles', 'name')],
            'email_verified' => ['nullable', Rule::in(['true', 'false'])],
            'search' => ['nullable', 'string', 'max:255'],
        ];
    }
}
