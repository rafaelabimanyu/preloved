<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'drop_id'      => 'nullable|exists:drops,id',
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'category'     => 'required|in:tops,bottoms,outerwear,accessories,shoes,bags',
            'size'         => 'nullable|string|max:50',
            'condition'    => 'required|in:mint,excellent,good,fair',
            'price'        => 'required|numeric|min:0',
            'status'       => 'required|in:available,reserved,sold',
            'instagram_url'=> 'nullable|url|max:255',
            'cover_image'  => 'nullable|image|max:4096',
            'gallery'      => 'nullable|array',
            'gallery.*'    => 'image|max:4096',
            'tags'         => 'nullable|array',
            'tags.*'       => 'exists:tags,id',
            'measurements' => 'nullable|array',
        ];
    }
}
