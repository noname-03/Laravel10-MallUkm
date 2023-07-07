<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check(); // <-------
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required',
            'title' => 'required',
            'price' => 'required',
            'price_retail' => 'required',
            'qty' => 'required',
            'unit' => 'required',
            'unit_variant' => 'required',
            'description' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:1028',
        ];
    }
}