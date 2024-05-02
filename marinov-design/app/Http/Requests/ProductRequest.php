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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'is_featured' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
            'type_id' => 'required|exists:types,id',
            'dimensions' => 'required|string',
            'weight' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'is_discounted' => 'required|boolean',
        ];
    }
}
