<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return \Auth::check();
    }

    public function rules(): array
    {
        return [
            'phone' => 'required',
            'terms' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'radius' => 'required',
            'provision' => 'required',
        ];
    }

    public function messages(): array
    {
        // message pakai bahasa indoensia
        return [
            'phone.required' => 'Nomor telepon tidak boleh kosong',
            'terms.required' => 'Syarat tidak boleh kosong',
            'latitude.required' => 'Latitude tidak boleh kosong',
            'longitude.required' => 'Longitude tidak boleh kosong',
            'provision.required' => 'ketentuan tidak boleh kosong',
            'radius.required' => 'Radius tidak boleh kosong'
        ];
    }

    public function attributes(): array
    {
        // attribute pakai bahasa indonesia
        return [
            'phone' => 'phone',
            'terms' => 'terms',
            'latitude' => 'latitude',
            'longitude' => 'longitude',
            'provision' => 'provision',
            'radius' => 'radius'
        ];
    }
}