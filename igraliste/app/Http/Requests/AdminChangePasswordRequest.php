<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminChangePasswordRequest extends FormRequest
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
            'old_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'old_password.required' => 'Старата лозинка е задолжителна.',
            'new_password.required' => 'Новата лозинка е задолжителна.',
            'new_password.string' => 'Новата лозинка мора да биде стринг.',
            'new_password.min' => 'Новата лозинка мора да содржи барем 8 карактери.',
            'new_password.confirmed' => 'Новата лозинка не се совпаѓа со потврдената лозинка.',
        ];
    }
}
