<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:category_products,id',
            'title' => 'required',
            'price' => 'required',
            'price_retail' => 'required',
            'qty' => 'required',
            'unit' => 'required',
            'unit_variant' => 'required',
            'description' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
        ];
    }
}