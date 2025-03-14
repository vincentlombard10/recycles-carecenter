<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => ['required'],
            'name' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
