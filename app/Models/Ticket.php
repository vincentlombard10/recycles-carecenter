<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;
    protected $guarded = [];

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
}
