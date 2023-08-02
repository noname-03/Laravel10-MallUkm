<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return \Auth::check();
    }

    public function rules(): array
    {
        return [
            'title' => 'required',
            'status' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Judul harus diisi',
            'status.required' => 'Status harus diisi',
            'status.boolean' => 'Status harus berupa true atau false',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'title',
            'status' => 'status',
        ];
    }
}