<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateProfileRequest extends FormRequest
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
        $adminId = Auth::id();
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $adminId,
            'phone_number' => 'nullable|string|max:255',
            'profile_picture' => 'sometimes|nullable|image|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Полето за име е задолжително.',
            'name.string' => 'Името мора да биде текст.',
            'name.max' => 'Името може да содржи најмногу 255 карактери.',
            'email.required' => 'Полето за е-пошта е задолжително.',
            'email.string' => 'Е-поштата мора да биде текст.',
            'email.email' => 'Внесете валидна е-пошта.',
            'email.max' => 'Е-поштата може да содржи најмногу 255 карактери.',
            'email.unique' => 'Е-поштата веќе е во употреба.',
            'phone_number.string' => 'Телефонскиот број мора да биде текст.',
            'phone_number.max' => 'Телефонскиот број може да содржи најмногу 255 карактери.',
            'profile_picture.image' => 'Профилната слика мора да биде слика.',
            'profile_picture.max' => 'Профилната слика не може да биде поголема од 2048 килобајти.',
        ];
    }
}
