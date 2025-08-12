<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductReportRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'identifier' => ['required'],
            'status' => ['required'],
            'type' => ['required'],
            'serial_code' => ['nullable'],
            'item_itno' => ['nullable'],
            'serial_id' => ['nullable', 'exists:serials'],
            'item_id' => ['nullable', 'exists:items'],
            'contact_id' => ['required', 'exists:contacts'],
            'reason' => ['nullable'],
            'comment' => ['nullable'],
            'battery_key' => ['nullable', 'boolean'],
            'antitheft_key' => ['nullable', 'boolean'],
            'charger' => ['nullable', 'boolean'],
            'battery' => ['nullable', 'boolean'],
            'pedals' => ['nullable', 'boolean'],
            'front_wheel' => ['nullable', 'boolean'],
            'rear_wheel' => ['nullable', 'boolean'],
            'saddle' => ['nullable', 'boolean'],
            'seatpost' => ['nullable', 'boolean'],
            'display' => ['nullable', 'boolean'],
            'motor' => ['nullable', 'boolean'],
            'presence_comment' => ['nullable'],
            'stripes' => ['nullable', 'boolean'],
            'corrosion' => ['nullable', 'boolean'],
            'clay' => ['nullable', 'boolean'],
            'sand' => ['nullable', 'boolean'],
            'impacts' => ['nullable', 'boolean'],
            'cracks' => ['nullable', 'boolean'],
            'breakages' => ['nullable', 'boolean'],
            'customizations' => ['nullable', 'boolean'],
            'check_comment' => ['nullable'],
            'issue_comment' => ['nullable'],
            'battery_reference' => ['nullable'],
            'battery_serial' => ['nullable'],
            'battery_type' => ['nullable'],
            'battery_voltage' => ['nullable', 'numeric'],
            'battery_capacity' => ['nullable', 'numeric'],
            'battery_look' => ['nullable', 'integer'],
            'battery_charge' => ['nullable', 'boolean'],
            'battery_issue' => ['nullable'],
            'battery_current_voltage' => ['nullable', 'numeric'],
            'battery_energy' => ['nullable', 'numeric'],
            'battery_cycles' => ['nullable', 'integer'],
            'battery_cells_state' => ['nullable'],
            'battery_current_capacity' => ['nullable', 'numeric'],
            'battery_temperature' => ['nullable', 'numeric'],
            'battery_internal_resistance' => ['nullable', 'numeric'],
            'diagnostic' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
