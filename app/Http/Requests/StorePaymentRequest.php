<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePaymentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'address_id' => 'required|exists:addresses,id',
            'courier' => 'required',
            'cost_courier' => 'required',
            'total' => 'required',
            'products' => 'required',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required',
            'products.*.variant' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'address_id.required' => 'Alamat wajib diisi',
            'address_id.exists' => 'Alamat tidak valid',
            'courier.required' => 'Kurir wajib diisi',
            'cost_courier.required' => 'Ongkos kirim wajib diisi',
            'total.required' => 'Total wajib diisi',
            'products.required' => 'Produk wajib diisi',
            'products.*.product_id.required' => 'Produk wajib diisi',
            'products.*.product_id.exists' => 'Produk tidak valid',
            'products.*.quantity.required' => 'Jumlah produk wajib diisi',
            'products.*.variant.required' => 'Varian produk wajib diisi',
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
