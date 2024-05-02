<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStep3Request extends FormRequest
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
            'address' => 'nullable',
            'phone_number' => 'nullable',
            'bio' => 'nullable',
            'picture' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'address.nullable' => 'Полето за адреса може да биде празно.',
            'phone_number.nullable' => 'Полето за телефонски број може да биде празно.',
            'bio.nullable' => 'Полето за биографија може да биде празно.',
            'picture.nullable' => 'Полето за слика може да биде празно.',
        ];
    }
}
