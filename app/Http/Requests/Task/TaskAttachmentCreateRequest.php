<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class TaskAttachmentCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file_path' => ['required', 'string', 'max:255', 'regex:/\.(jpg|jpeg|png|webp|pdf|doc|docx|xls|xlsx|txt)$/i'],
            'order_index' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
