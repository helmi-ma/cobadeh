<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
    $mediaId = $this->route('medium');

    return [
        'title' => [
            'required',
            'string',
            Rule::unique('media', 'title')->ignore($mediaId),
            ],
        'type' => 'required|string',
        'genre' => 'required|string',
        'description' => 'nullable|string',
        ];
    }
}
