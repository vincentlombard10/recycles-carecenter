<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SerialAdditionalsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'serial_code' => ['required'],
            'serial_id' => ['required', 'exists:serials'],
            'qualificiation' => ['required'],
            'reference' => ['required'],
            'category' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
