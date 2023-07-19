<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarouselRequest extends FormRequest
{
    public function authorize(): bool
    {
        return \Auth::check();
    }

    public function rules(): array
    {
        return [
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
        ];
    }

    public function messages(): array
    {
        return [
            'photo.required' => 'Foto harus diisi',
            'photo.image' => 'Foto harus berupa gambar',
            'photo.mimes' => 'Foto harus berupa file jpeg, png, jpg, gif, svg, atau webp',
            'photo.max' => 'Foto maksimal berukuran 1 MB',
        ];
    }

    public function attributes(): array
    {
        return [
            'photo' => 'Photo',
        ];
    }
}