<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Metric extends Model
{
    use SoftDeletes;

    protected $table = 'metrics';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'agent_wait_time_in_minutes' => 'array',
            'assignee_updated_at' => 'timestamp',
            'created_at' => 'timestamp',
            'custom_status_updated_at' => 'timestamp',
            'first_resolution_time_in_minutes' => 'array',
            'full_resolution_time_in_minutes' => 'array',
            'initially_assigned_at' => 'timestamp',
            'latest_comment_added_at' => 'timestamp',
            'on_hold_time_in_minutes' => 'timestamp',
            'requester_updated_at' => 'timestamp',
            'requester_wait_time_in_minutes' => 'array',
            'solved_at' => 'timestamp',
            'status_updated_at' => 'timestamp',
            'updated_at' => 'timestamp',
        ];
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

}
