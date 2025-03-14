<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DealerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => ['required'],
            'name' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
