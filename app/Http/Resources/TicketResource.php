<?php

namespace App\Http\Resources;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Ticket */
class TicketResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'allow_attachments' => $this->allow_attachments,
            'allow_channelback' => $this->allow_channelback,
            'assignee_email' => $this->assignee_email,
            'assignee_id' => $this->assignee_id,
            'attribute_value_ids' => $this->attribute_value_ids,
            'brand_id' => $this->brand_id,
            'collaborator_ids' => $this->collaborator_ids,
            'collaborators' => $this->collaborators,
            'custom_fields' => $this->custom_fields,
            'custom_status_id' => $this->custom_status_id,
            'description' => $this->description,
            'due_at' => $this->due_at,
            'email_cc_ids' => $this->email_cc_ids,
            'external_id' => $this->external_id,
            'follower_ids' => $this->follower_ids,
            'followup_ids' => $this->followup_ids,
            'forum_topic_id' => $this->forum_topic_id,
            'from_messaging_channel' => $this->from_messaging_channel,
            'generated_timestamp' => $this->generated_timestamp,
            'group_id' => $this->group_id,
            'has_incidents' => $this->has_incidents,
            'is_public' => $this->is_public,
            'organization_id' => $this->organization_id,
            'priority' => $this->priority,
            'problem_id' => $this->problem_id,
            'raw_subject' => $this->raw_subject,
            'recipient' => $this->recipient,
            'requester_id' => $this->requester_id,
            'satisfaction_rating' => $this->satisfaction_rating,
            'sharing_agreement_ids' => $this->sharing_agreement_ids,
            'status' => $this->status,
            'subject' => $this->subject,
            'submitter_id' => $this->submitter_id,
            'tags' => $this->tags,
            'ticket_form_id' => $this->ticket_form_id,
            'type' => $this->type,
            'url' => $this->url,
            'via' => $this->via,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
