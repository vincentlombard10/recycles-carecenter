<?php

use App\Models\Ticket;
use Zendesk\API\HttpClient as ZendeskAPI;

Schedule::command('items:import --file=' . \Carbon\Carbon::now()->format('ymd'))
    ->dailyAt('20:00');

Schedule::command('serials:import --file=' . \Carbon\Carbon::now()->format('ymd'))
    ->dailyAt('20:05');

Schedule::command('contacts:import --file=' . \Carbon\Carbon::now()->format('ymd'))
    ->dailyAt('20:10');

#Importation des tickets chaque minute
/*Schedule::call(function () {

    Log::info("Importation des tickets Zendesk ...");

    ini_set('max_execution_time', 3600);
    ini_set('memory_limit', '-1');

    $client = new ZendeskAPI(config('zendesk.subdomain'));
    $client->setAuth(config('zendesk.auth_strategy'), [
        'username' => config('zendesk.username'),
        'token' => config('zendesk.token')
    ]);

    $startTime = \Carbon\Carbon::now()->subDays(5)->timestamp;

    $tickets = $client->tickets()->export(['start_time' => $startTime]);
    foreach ($tickets->results as $ticket) {
        try {
            $ticket = Ticket::updateOrCreate(
                attributes: ['id' => $ticket->id],
                values: [
                    'generated_timestamp' => intval($ticket->generated_timestamp),
                    'requester_id' => intval($ticket->req_id),
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
                ]
            );
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

})->everyFiveMinutes();*/
