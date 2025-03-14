<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MetricRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'agent_wait_time_in_minutes' => ['nullable'],
            'assigned_at' => ['nullable'],
            'assignee_stations' => ['nullable', 'integer'],
            'assignee_updated_at' => ['nullable', 'date'],
            'custom_status_updated_at' => ['nullable', 'date'],
            'first_resolution_time_in_minutes' => ['nullable'],
            'full_resolution_time_in_minutes' => ['nullable'],
            'group_stations' => ['nullable', 'integer'],
            'initially_assigned_at' => ['nullable', 'date'],
            'latest_comment_added_at' => ['nullable', 'date'],
            'on_hold_time_in_minutes' => ['nullable', 'date'],
            'reopens' => ['nullable', 'integer'],
            'replies' => ['nullable', 'integer'],
            'reply_time_in_minutes' => ['nullable', 'integer'],
            'reply_time_in_seconds' => ['nullable', 'integer'],
            'requester_updated_at' => ['nullable', 'date'],
            'requester_wait_time_in_minutes' => ['nullable'],
            'solved_at' => ['nullable', 'date'],
            'status_updated_at' => ['nullable', 'date'],
            'ticket_id' => ['nullable', 'exists:tickets'],
            'url' => ['nullable'],
            'ticket_id' => ['required', 'exists:tickets'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
