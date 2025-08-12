<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomFIeldOptionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'custom_field_id' => ['required', 'exists:custom_fields'],
            'identifier' => ['required'],
            'label' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
