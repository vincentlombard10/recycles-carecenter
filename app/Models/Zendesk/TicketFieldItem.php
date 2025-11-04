<?php

namespace App\Models\Zendesk;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketFieldItem extends Model
{
    use HasUuids;

    public $timestamps = false;

    protected $fillable = [
        'ticketfield_id',
        'ticket_id',
        'value',
    ];

    public function ticketField(): BelongsTo
    {
        return $this->belongsTo(TicketField::class);
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }
}
