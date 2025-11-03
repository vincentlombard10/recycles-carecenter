<?php

namespace App\Http\Controllers\Zendesk;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Zendesk\API\HttpClient as ZendeskAPI;
class SyncZendeskTicketController extends Controller
{
    public function __invoke(string $ticketID)
    {
        ini_set('max_execution_time', 360);
        ini_set('memory_limit', '-1');
        $subdomain = config('zendesk.subdomain');
        $username = config('zendesk.username');
        $token = config('zendesk.token');

        $client = new ZendeskAPI($subdomain);
        $client->setAuth(config('zendesk.auth_strategy'), ['username' => $username, 'token' => $token]);

        $ticketsData = $client->tickets()->find($ticketID);
        $ticket = $ticketsData->ticket;
        dump($ticket);
        $ticketMetric = $client->tickets($ticketID)->metrics()->findAll()->ticket_metric;
        dump($ticketMetric);
        $ticketComments = $client->tickets($ticketID)->comments()->findAll()->comments;
        dd($ticketComments);
        try {

            Log::alert("Webhook Process Job");

            Ticket::updateOrCreate([
                'id' => $ticket->id,
            ], [
                'generated_timestamp' => intval($ticket->generated_timestamp),
                'requester_id' => intval($ticket->requester_id),
                'assignee_id' => intval($ticket->assignee_id),
                'replies' => intval($ticketMetric->replies),
                'reopens' => intval($ticketMetric->reopens),
                'first_reply_time_in_minutes' => intval($ticketMetric->reply_time_in_minutes->calendar),
                'first_reply_time_in_minutes_within_business_hours' => intval($ticketMetric->reply_time_in_minutes->business),
                'first_resolution_time_in_minutes' => intval($ticketMetric->first_resolution_time_in_minutes->calendar),
                'first_resolution_time_in_minutes_within_business_hours' => intval($ticketMetric->first_resolution_time_in_minutes->business),
                'full_resolution_time_in_minutes' => intval($ticketMetric->full_resolution_time_in_minutes->calendar),
                'full_resolution_time_in_minutes_within_business_hours' => intval($ticketMetric->full_resolution_time_in_minutes->business),
                'agent_wait_time_in_minutes' => intval($ticketMetric->agent_wait_time_in_minutes->calendar),
                'agent_wait_time_in_minutes_within_business_hours' => intval($ticketMetric->agent_wait_time_in_minutes->business),
                'requester_wait_time_in_minutes' => intval($ticketMetric->requester_wait_time_in_minutes->calendar),
                'requester_wait_time_in_minutes_within_business_hours' => intval($ticketMetric->requester_wait_time_in_minutes->business),
                'on_hold_time_in_minutes' => intval($ticketMetric->on_hold_time_in_minutes->calendar),
                'on_hold_time_in_minutes_within_business_hours' => intval($ticketMetric->on_hold_time_in_minutes->business),
                'first_reply_time_in_seconds' => intval($ticketMetric->reply_time_in_seconds->calendar),
                //'ticket_form_name' => $ticket->ticket_form_name,
                //'requester_external_id' => $ticket->req_external_id,
                //'requester_name' => $ticket->req_name,
                //'requester_email' => $ticket->req_email,
                //'assignee_name' => $ticket->assignee_name,
                //'brand_name' => $ticket->brand_name,
                'satisfaction_score' => $ticket->satisfaction_rating->score,
                'status' => $ticket->status,
                'tags' => $ticket->tags,
                'url' => $ticket->url,
                'via' => $ticket->via,
                'subject' => $ticket->subject,
                'priority' => $ticket->priority,
                'created_at' => $ticketMetric->created_at,
                'assigned_at' => $ticketMetric->assigned_at ? Str::substr($ticketMetric->assigned_at, 0, 19) : null,
                'solved_at' => $ticketMetric->solved_at ? Str::substr($ticketMetric->solved_at, 0, 19) : null,
                'updated_at' => $ticketMetric->updated_at,
            ]);

            //Log::debug('New support', ['support' => (new Ticket())->getSupport($this->webhookCall->payload['support'])]);

        } catch (\Exception $exception) {

            Log::error('Ticket Update (webhook) : ' . $exception->getMessage());

        }
    }
}
