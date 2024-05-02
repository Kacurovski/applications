<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStep1Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Полето за е-пошта е задолжително.',
            'email.email' => 'Е-поштата мора да биде валидна адреса.',
            'password.required' => 'Полето за лозинка е задолжително.',
            'password.min' => 'Лозинката мора да содржи најмалку 8 карактери.',
        ];
    }
}
