<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'allow_attachments',
        'allow_channelback',
        'assignee_email',
        'assignee_id',
        'attribute_value_ids',
        'brand_id',
        'collaborator_ids',
        'collaborators',
        'custom_fields',
        'custom_status_id',
        'description',
        'due_at',
        'email_cc_ids',
        'external_id',
        'follower_ids',
        'followup_ids',
        'forum_topic_id',
        'from_messaging_channel',
        'generated_timestamp',
        'group_id',
        'has_incidents',
        'is_public',
        'organization_id',
        'priority',
        'problem_id',
        'raw_subject',
        'recipient',
        'requester_id',
        'satisfaction_rating',
        'sharing_agreement_ids',
        'status',
        'subject',
        'submitter_id',
        'tags',
        'ticket_form_id',
        'type',
        'url',
        'via',
    ];

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
}
