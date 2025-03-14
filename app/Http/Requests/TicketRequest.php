<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'allow_attachments' => ['nullable', 'boolean'],
            'allow_channelback' => ['nullable', 'boolean'],
            'assignee_email' => ['nullable', 'email', 'max:254'],
            'assignee_id' => ['nullable', 'integer'],
            'attribute_value_ids' => ['nullable'],
            'brand_id' => ['nullable', 'integer'],
            'collaborator_ids' => ['nullable'],
            'collaborators' => ['nullable'],
            'custom_fields' => ['nullable'],
            'custom_status_id' => ['nullable', 'integer'],
            'description' => ['nullable'],
            'due_at' => ['nullable', 'date'],
            'email_cc_ids' => ['nullable'],
            'external_id' => ['nullable'],
            'follower_ids' => ['nullable'],
            'followup_ids' => ['nullable'],
            'forum_topic_id' => ['nullable', 'integer'],
            'from_messaging_channel' => ['nullable', 'boolean'],
            'generated_timestamp' => ['nullable', 'date'],
            'group_id' => ['nullable', 'integer'],
            'has_incidents' => ['nullable', 'boolean'],
            'is_public' => ['nullable', 'boolean'],
            'organization_id' => ['nullable', 'integer'],
            'priority' => ['nullable'],
            'problem_id' => ['nullable', 'integer'],
            'raw_subject' => ['nullable'],
            'recipient' => ['nullable'],
            'requester_id' => ['required', 'integer'],
            'satisfaction_rating' => ['nullable'],
            'sharing_agreement_ids' => ['nullable'],
            'status' => ['nullable', 'integer'],
            'subject' => ['nullable'],
            'submitter_id' => ['nullable', 'integer'],
            'tags' => ['nullable'],
            'ticket_form_id' => ['nullable', 'integer'],
            'type' => ['nullable'],
            'url' => ['nullable'],
            'via' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
