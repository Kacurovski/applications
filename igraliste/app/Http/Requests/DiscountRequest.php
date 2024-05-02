<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'percent' => 'required|numeric',
            'status_id' => 'required|exists:statuses,id',
            'categories' => 'required|array',
            'categories.*' => 'exists:discount_categories,id',
            'products' => 'required',
        ];

    }

    public function messages()
    {
        return [
            'name.required' => 'Полето за име е задолжително.',
            'name.string' => 'Името мора да биде текст.',
            'name.max' => 'Името не може да биде подолго од 255 карактери.',
            'percent.required' => 'Полето за процент е задолжително.',
            'percent.numeric' => 'Процентот мора да биде број.',
            'status_id.required' => 'Полето за статус е задолжително.',
            'status_id.exists' => 'Избраниот статус не е валиден.',
            'categories.required' => 'Полето за категории е задолжително.',
            'categories.array' => 'Категориите мора да бидат во формат на низа.',
            'categories.*.exists' => 'Избраната категорија не постои.',
        ];
    }
}
