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
            'allowAttachments' => $this->allow_attachments,
            'allowChannelback' => $this->allow_channelback,
            'assigneeEmail' => $this->assignee_email,
            'assigneeID' => $this->assignee_id,
            'attributeValueIds' => $this->attribute_value_ids,
            'brandId' => $this->brand_id,
            'collaboratorIds' => $this->collaborator_ids,
            'collaborators' => $this->collaborators,
            'customFields' => $this->custom_fields,
            'customStatusID' => $this->custom_status_id,
            'description' => $this->description,
            'dueAt' => $this->due_at,
            'emailCcIds' => $this->email_cc_ids,
            'externalID' => $this->external_id,
            'followerIds' => $this->follower_ids,
            'followupIds' => $this->followup_ids,
            'forumTopicId' => $this->forum_topic_id,
            'fromMessagingChannel' => $this->from_messaging_channel,
            'generatedIimestamp' => $this->generated_timestamp,
            'groupId' => $this->group_id,
            'hasIncidents' => $this->has_incidents,
            'isPublic' => $this->is_public,
            'organizationId' => $this->organization_id,
            'priority' => $this->priority,
            'problemId' => $this->problem_id,
            'rawSubject' => $this->raw_subject,
            'recipient' => $this->recipient,
            'requesterId' => $this->requester_id,
            'requesterEmail' => $this->requester_email,
            'requesterName' => $this->requester_name,
            'satisfactionRating' => $this->satisfaction_rating,
            'sharing_agreementIds' => $this->sharing_agreement_ids,
            'status' => $this->status,
            'subject' => $this->subject,
            'submitterId' => $this->submitter_id,
            'tags' => $this->tags,
            'ticketFormId' => $this->ticket_form_id,
            'type' => $this->type,
            'url' => $this->url,
            'via' => $this->via,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
