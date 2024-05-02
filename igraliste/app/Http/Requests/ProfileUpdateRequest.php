<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }

    public function messages(): array
{
    return [
        'name.required' => 'Полето за име е задолжително.',
        'name.string' => 'Името мора да биде текст.',
        'name.max' => 'Името не смее да биде подолго од 255 карактери.',
        'email.required' => 'Полето за е-пошта е задолжително.',
        'email.string' => 'Е-поштата мора да биде текст.',
        'email.lowercase' => 'Е-поштата мора да биде напишана со мали букви.',
        'email.email' => 'Е-поштата мора да биде валидна адреса.',
        'email.max' => 'Е-поштата не смее да биде подолга од 255 карактери.',
        'email.unique' => 'Е-поштата веќе постои во системот.',
    ];
}
}
