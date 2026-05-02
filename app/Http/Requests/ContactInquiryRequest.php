<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactInquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'instagram_handle' => 'nullable|string|max:100',
            'message'          => 'required|string|max:2000',
            'item_id'          => 'nullable|exists:items,id',
        ];
    }

    public function messages(): array
    {
        return [
            'message.required' => 'Please write something — we\'d love to hear from you.',
            'email.email'      => 'Please enter a valid email address.',
        ];
    }
}
