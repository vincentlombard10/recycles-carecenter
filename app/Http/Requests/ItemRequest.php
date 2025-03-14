<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'itno' => ['required'],
            'itds' => ['required'],
            'label' => ['nullable'],
            'group_id' => ['required', 'exists:groups'],
            'brand_id' => ['required', 'exists:brands'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
