<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CateogryProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return \Auth::check();
    }

    public function rules(): array
    {
        return [
            'title' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul harus diisi',
            'file.required' => 'Foto harus diisi',
            'file.image' => 'Foto harus berupa gambar',
            'file.mimes' => 'Foto harus berupa file jpeg, png, jpg, gif, svg, atau webp',
            'file.max' => 'Foto maksimal berukuran 1 MB',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Judul',
            'file' => 'Foto',
        ];
    }
}