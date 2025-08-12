<?php

namespace App\Models\Zendesk;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketField extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
            'required' => 'boolean',
            'collapsed_for_agents' => 'boolean',
            'visible_in_portal' => 'boolean',
            'editable_in_portal' => 'boolean',
            'required_in_portal' => 'boolean',
            'agent_can_edit' => 'boolean',
            'removable' => 'boolean',
        ];
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
}
