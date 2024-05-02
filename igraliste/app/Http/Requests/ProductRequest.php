<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'brand_id' => 'required|exists:brands,id',
            'status_id' => 'required|exists:statuses,id',
            'category_id' => 'required|exists:categories,id',
            'size_id' => 'required|exists:sizes,id',
            'size_advice' => 'required|max:255',
            'color_id' => 'required|exists:colors,id',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'discount_id' => 'nullable|exists:discounts,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Полето за име е задолжително.',
            'description.required' => 'Полето за опис е задолжително.',
            'price.required' => 'Полето за цена е задолжително.',
            'quantity.required' => 'Полето за количина е задолжително.',
            'brand_id.required' => 'Мора да изберете бренд.',
            'status_id.required' => 'Мора да изберете статус.',
            'category_id.required' => 'Мора да изберете категорија.',
            'size_id.required' => 'Мора да изберете големина.',
            'size_advice.required' => 'Полето за совет за величина е задолжително.',
            'size_advice.max' => 'Советот за величина не смее да биде подолг од 255 карактери.',
            'color_id.required' => 'Мора да изберете боја.',
            'images.*.image' => 'Сликата мора да биде во валиден формат.',
            'images.*.mimes' => 'Сликата мора да биде во еден од следните формати: jpeg, png, jpg, gif, svg.',
            'images.*.max' => 'Сликата не смее да биде поголема од 2048 килобајти.',
            'discount_id.exists' => 'Избраниот попуст не постои.'
        ];
    }
}