<?php

namespace App\Http\Resources;

use App\Models\Metric;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Metric */
class MetricResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'agent_wait_time_in_minutes' => $this->agent_wait_time_in_minutes,
            'assigned_at' => $this->assigned_at,
            'assignee_stations' => $this->assignee_stations,
            'assignee_updated_at' => $this->assignee_updated_at,
            'created_at' => $this->created_at,
            'custom_status_updated_at' => $this->custom_status_updated_at,
            'first_resolution_time_in_minutes' => $this->first_resolution_time_in_minutes,
            'full_resolution_time_in_minutes' => $this->full_resolution_time_in_minutes,
            'group_stations' => $this->group_stations,
            'initially_assigned_at' => $this->initially_assigned_at,
            'latest_comment_added_at' => $this->latest_comment_added_at,
            'on_hold_time_in_minutes' => $this->on_hold_time_in_minutes,
            'reopens' => $this->reopens,
            'replies' => $this->replies,
            'reply_time_in_minutes' => $this->reply_time_in_minutes,
            'reply_time_in_seconds' => $this->reply_time_in_seconds,
            'requester_updated_at' => $this->requester_updated_at,
            'requester_wait_time_in_minutes' => $this->requester_wait_time_in_minutes,
            'solved_at' => $this->solved_at,
            'status_updated_at' => $this->status_updated_at,
            'updated_at' => $this->updated_at,
            'url' => $this->url,
            'ticket_id' => $this->ticket_id,
            'ticket' => new TicketResource($this->whenLoaded('ticket')),
        ];
    }
}
