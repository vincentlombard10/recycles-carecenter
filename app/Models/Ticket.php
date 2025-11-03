<?php

namespace App\Models;

use App\Models\Traits\Attribute\TicketAttribute;
use App\Models\Traits\Scope\TicketScope;
use App\Models\Zendesk\TicketField;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes,
        TicketScope,
        TicketAttribute;

    protected $table = 'tickets';

    protected $guarded = [];

    public const STATUS_NEW = "New";
    public const STATUS_OPEN = "Open";
    public const STATUS_HOLD = "Hold";
    public const STATUS_PENDING = "Pending";
    public const STATUS_SOLVED = "Solved";
    public const STATUS_CLOSED = "Closed";

    protected function casts(): array
    {
        return [
            'allow_attachments' => 'boolean',
            'allow_channelback' => 'boolean',
            'attribute_value_ids' => 'array',
            'collaborator_ids' => 'array',
            'collaborators' => 'array',
            'created_at' => 'timestamp',
            'custom_fields' => 'array',
            'due_at' => 'timestamp',
            'email_cc_ids' => 'array',
            'follower_ids' => 'array',
            'followup_ids' => 'array',
            'from_messaging_channel' => 'boolean',
            'generated_timestamp' => 'timestamp',
            'has_incidents' => 'boolean',
            'is_public' => 'boolean',
            'satisfaction_rating' => 'array',
            'sharing_agreement_ids' => 'array',
            'tags' => 'array',
            'updated_at' => 'timestamp',
            'via' => 'array',
        ];
    }

    public function returns(): HasMany
    {
        return $this->hasMany(ProductReturn::class, 'ticket_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'ticket_id');
    }

    public function ticketFields(): BelongsToMany
    {
        return $this->belongsToMany(TicketField::class, 'ticket_ticketfield', 'ticket_id', 'field_id');
    }
}
