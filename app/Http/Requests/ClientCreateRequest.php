<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:100', Rule::unique('clients')],
            'logo' => ['nullable', 'string', 'max:255', 'regex:/\.(jpg|jpeg|png|webp)$/i'],
            'notes' => ['nullable', 'string', 'min:2'],
        ];
    }
}
