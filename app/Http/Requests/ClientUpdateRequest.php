<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'min:2', 'max:100',
                Rule::unique('clients')->ignore($this->route('client')),],
            'logo' => ['sometimes', 'nullable', 'string', 'max:255', 'regex:/\.(jpg|jpeg|png|webp)$/i'],
            'notes' => ['sometimes', 'nullable', 'string', 'min:2'],
        ];
    }
}
