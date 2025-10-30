<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'address1' => ['nullable'],
            'address2' => ['nullable'],
            'postcode' => ['required'],
            'city' => ['required'],
            'is_primary' => ['required'],
            'is_active' => ['required'],
            'contact_id' => ['required', 'exists:contacts'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
