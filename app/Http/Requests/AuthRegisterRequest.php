<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AuthRegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:50'],
            'surname' => ['nullable', 'string', 'min:2', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
            'profile_photo' => ['nullable', 'string', 'max:255', 'regex:/\.(jpg|jpeg|png|webp)$/i'],
            'job_title' => ['nullable', 'string', 'min:2', 'max:100'],
            'phone_number' => ['nullable', 'string', 'min:2', 'max:20', 'regex:/^\+?[0-9]+$/'],
        ];
    }
}
