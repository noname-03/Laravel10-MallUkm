<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCateogryProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return \Auth::check();
    }

    public function rules(): array
    {
        // Tentukan aturan validasi untuk request update category product
        $rules = [
            // Contoh aturan validasi untuk field "title"
            'title' => 'required|string|max:255',
        ];

        // Validasi field "file" hanya jika ada file foto yang diunggah
        if ($this->hasFile('file')) {
            $rules['file'] = 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024';
        }

        return $rules;
    }

    public function messages(): array
    {
        // Tentukan pesan kesalahan untuk setiap aturan validasi yang ditentukan
        return [
            // Pesan kesalahan untuk field "title"
            'title.required' => 'Judul harus diisi',
            'title.string' => 'Judul harus berupa teks',
            'title.max' => 'Judul tidak boleh lebih dari :max karakter',

            // Contoh pesan kesalahan untuk field "file"
            'file.image' => 'File harus berupa gambar',
            'file.mimes' => 'File harus berupa salah satu dari: jpeg, png, jpg, gif, svg, webp',
            'file.max' => 'Ukuran file tidak boleh lebih dari 1 MB'
        ];
    }

    public function attributes(): array
    {
        // Tentukan atribut (label) untuk setiap field yang akan digunakan dalam pesan kesalahan
        return [
            'title' => 'Judul',
            // Contoh atribut untuk field "file"
            'file' => 'File'
        ];
    }
}