<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreAddressRequest extends FormRequest
{

    public function rules()
    {
        return [
            'username' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'destination_id' => 'required',
            'address_detail' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Nama wajib diisi',
            'phone.required' => 'Nomor Telepon wajib diisi',
            'address.required' => 'Alamat wajib diisi',
            'destination_id.required' => 'ID Kecamatan wajib diisi',
            'address_detail.required' => 'Detail Alamat wajib diisi',
            'status.required' => 'Status wajib diisi',
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