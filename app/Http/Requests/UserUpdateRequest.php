<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'min:2', 'max:50'],
            'surname' => ['sometimes', 'nullable', 'string', 'min:2', 'max:50'],
            'email' => ['sometimes', 'string', 'email', 'max:255',
                Rule::unique('users')->ignore($this->route('user')),],
            'password' => ['sometimes', 'string', 'min:8', 'max:255', 'confirmed'],
            'profile_photo' => ['sometimes', 'nullable', 'string', 'max:255', 'regex:/\.(jpg|jpeg|png|webp)$/i'],
            'job_title' => ['sometimes', 'nullable', 'string', 'min:2', 'max:100'],
            'phone_number' => ['sometimes', 'nullable', 'string', 'min:2', 'max:20', 'regex:/^\+?[0-9]+$/'],
        ];
    }
}
