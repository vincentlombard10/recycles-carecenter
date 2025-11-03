<?php

namespace App\Webhooks\Jobs;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\Ticket;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob;
use Spatie\WebhookClient\Models\WebhookCall;
use Zendesk\API\HttpClient as ZendeskAPI;

class UpdateOrCreateTicketWebhookJob extends ProcessWebhookJob
{
    public function __construct(public WebhookCall $webhookCall)
    {
        parent::__construct($webhookCall);
    }

    public function handle(): void
    {

        Log::debug('Ticket Payload', ['payload' => $this->webhookCall->payload]);

        $client = new ZendeskAPI(config('zendesk.subdomain'));
        $client->setAuth(config('zendesk.auth_strategy'), [
            'username' => config('zendesk.username'),
            'token' => config('zendesk.token')
        ]);

        $ticketsData = $client->tickets()->find($this->webhookCall->payload['id']);
        $ticket = $ticketsData->ticket;
        Log::debug('Ticket', ['ticket' => $ticket]);
        try {

            Log::alert("Webhook Process Job");

            Ticket::updateOrCreate([
                'id' => $ticket->id,
            ], [
                'generated_timestamp' => intval($ticket->generated_timestamp),
                'requester_id' => intval($ticket->requester_id),
                'assignee_id' => intval($ticket->assignee_id),
                'replies' => intval($ticket->replies),
                'reopens' => intval($ticket->reopens),
                'first_reply_time_in_minutes' => intval($ticket->first_reply_time_in_minutes),
                'first_reply_time_in_minutes_within_business_hours' => intval($ticket->first_reply_time_in_minutes_within_business_hours),
                'first_resolution_time_in_minutes' => intval($ticket->first_resolution_time_in_minutes),
                'first_resolution_time_in_minutes_within_business_hours' => intval($ticket->first_reply_time_in_minutes_within_business_hours),
                'full_resolution_time_in_minutes' => intval($ticket->full_resolution_time_in_minutes),
                'full_resolution_time_in_minutes_within_business_hours' => intval($ticket->full_resolution_time_in_minutes_within_business_hours),
                'agent_wait_time_in_minutes' => intval($ticket->agent_wait_time_in_minutes),
                'agent_wait_time_in_minutes_within_business_hours' => intval($ticket->agent_wait_time_in_minutes_within_business_hours),
                'requester_wait_time_in_minutes' => intval($ticket->requester_wait_time_in_minutes),
                'requester_wait_time_in_minutes_within_business_hours' => intval($ticket->requester_wait_time_in_minutes_within_business_hours),
                'on_hold_time_in_minutes' => intval($ticket->on_hold_time_in_minutes),
                'on_hold_time_in_minutes_within_business_hours' => intval($ticket->on_hold_time_in_minutes_within_business_hours),
                'first_reply_time_in_seconds' => intval($ticket->first_reply_time_in_seconds),
                'ticket_form_name' => $ticket->ticket_form_name,
                'requester_external_id' => $ticket->req_external_id,
                'requester_name' => $ticket->req_name,
                'requester_email' => $ticket->req_email,
                'assignee_name' => $ticket->assignee_name,
                'brand_name' => $ticket->brand_name,
                'satisfaction_score' => $ticket->satisfaction_score,
                'status' => $ticket->status,
                'tags' => $ticket->current_tags,
                'url' => $ticket->url,
                'via' => $ticket->via,
                'subject' => $ticket->subject,
                'priority' => $ticket->priority,
                'created_at' => $ticket->created_at,
                'assigned_at' => $ticket->assigned_at ? Str::substr($ticket->assigned_at, 0, 19) : null,
                'solved_at' => $ticket->solved_at ? Str::substr($ticket->solved_at, 0, 19) : null,
                'updated_at' => $ticket->updated_at,
            ]);

            //Log::debug('New support', ['support' => (new Ticket())->getSupport($this->webhookCall->payload['support'])]);

        } catch (Exception $e) {

            Log::error('Ticket Update (webhook) : ' . $e->getMessage());

        }

    }


}
