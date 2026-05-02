<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLookbookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'cover_image'    => 'nullable|image|max:4096',
            'published_at'   => 'nullable|date',
            'images'         => 'nullable|array',
            'images.*'       => 'image|max:4096',
            'captions'       => 'nullable|array',
            'captions.*'     => 'nullable|string|max:255',
            'linked_items'   => 'nullable|array',
            'linked_items.*' => 'nullable|exists:items,id',
        ];
    }
}
