<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SerialRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => ['required'],
            'item_itno' => ['required'],
            'in' => ['required', 'date'],
            'out' => ['required', 'date'],
            'dealer_code' => ['required'],
            'order' => ['required'],
            'delivery' => ['required'],
            'group_code' => ['required'],
            'brand_code' => ['required'],
            'group_id' => ['required', 'exists:groups'],
            'brand_id' => ['required', 'exists:brands'],
            'item_id' => ['required', 'exists:items'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
