<?php

namespace App\Http\Requests\Activity;

use App\Enums\SubjectType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class ActivityFilterRequest extends FormRequest
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
            'sort_by' => ['nullable',
                Rule::in(['id', 'log_name', 'description', 'event', 'created_at', 'updated_at'])],
            'sort_order' => ['nullable', Rule::in(['asc', 'desc'])],
            'causer_id' => ['nullable', 'integer', Rule::exists('users', 'id')],
            'subject_type' => ['nullable', 'required_with:subject_id', new Enum(SubjectType::class)],
            'subject_id' => ['nullable', 'integer'],
            'log_name' => ['nullable', 'string', 'max:100'],
            'event' => ['nullable', 'string', 'max:100'],
            'created_from' => ['nullable', 'date'],
            'created_to' => ['nullable', 'date', 'after_or_equal:created_from'],
        ];
    }
}
