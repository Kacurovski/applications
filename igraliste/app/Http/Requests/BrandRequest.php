<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
            'name' => 'required|max:255',
            'description' => 'required',
            'status_id' => 'required|exists:statuses,id',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Полето за име е задолжително.',
            'name.max' => 'Името не може да биде подолго од 255 карактери.',
            'description.required' => 'Описот е задолжителен.',
            'status_id.required' => 'задолжително',
            'status_id.exists' => 'Избраниот статус не е валиден.',
            'categories.required' => 'Полето за категории е задолжително.',
            'categories.array' => 'Категориите мора да бидат во формат на низа.',
            'categories.*.exists' => 'Избраната категорија не постои.',
            'images.required' => 'Полето за слики е задолжително',
            'images.array' => 'Сликите мора да бидат во формат на низа.',
            'images.*.image' => 'Датотеката мора да биде слика.',
            'images.*.mimes' => 'Сликата мора да биде во еден од следниве формати: jpeg, png, jpg, gif, svg.',
            'images.*.max' => 'Сликата не смее да биде поголема од 2048 килобајти.',
        ];
    }
}
