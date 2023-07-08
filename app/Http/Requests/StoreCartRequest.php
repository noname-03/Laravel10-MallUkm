<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreCartRequest extends FormRequest
{
    public function rules()
    {
        return [
            'product_id' => 'required',
            'qty' => 'required',
            'unit_variant' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => 'Product_id wajib diisi',
            'qty.required' => 'Kuantitas wajib diisi',
            'unit_variant.required' => 'Varian Satuan wajib diisi',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'code' => 400,
            'message' => $validator->errors()
        ]));
    }

}