<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStep2Request extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Полето за име е задолжително.',
            'first_name.string' => 'Името мора да биде текст.',
            'first_name.max' => 'Името не смее да биде подолго од 255 карактери.',
            'last_name.required' => 'Полето за презиме е задолжително.',
            'last_name.string' => 'Презимето мора да биде текст.',
            'last_name.max' => 'Презимето не смее да биде подолго од 255 карактери.',
            'email.required' => 'Полето за е-пошта е задолжително.',
            'email.email' => 'Е-поштата мора да биде валидна адреса.',
            'email.unique' => 'Е-поштата веќе постои во системот.',
            'password.required' => 'Полето за лозинка е задолжително.',
            'password.min' => 'Лозинката мора да содржи најмалку 8 карактери.',
            'password_confirmation.required' => 'Потврдата на лозинката е задолжителна.',
            'password_confirmation.same' => 'Лозинките не се совпаѓаат.',
        ];
    }
}
