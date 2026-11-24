<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|unique:media,title',
            'type' => 'required|string',
            'genre' => 'required|string',
            'description' => 'nullable|string',
        ];
    }
}
