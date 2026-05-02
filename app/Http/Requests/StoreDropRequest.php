<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDropRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'cover_image'  => 'nullable|image|max:4096',
            'status'       => 'required|in:draft,scheduled,live,ended',
            'released_at'  => 'nullable|date',
            'ended_at'     => 'nullable|date|after_or_equal:released_at',
        ];
    }
}
