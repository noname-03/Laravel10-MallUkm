<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return \Auth::check();
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:category_products,id',
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'price_retail' => 'nullable|numeric|min:0',
            'promo' => 'nullable|numeric|min:0',
            'qty' => 'required|integer|min:0',
            'weight' => 'required|numeric|min:0',
            'unit' => 'required|string|max:255',
            'unit_variant' => 'required|string',
            'description' => 'required|string',
            'photo' => 'nullable|array',
            'photo.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:1024',
        ];
    }
}