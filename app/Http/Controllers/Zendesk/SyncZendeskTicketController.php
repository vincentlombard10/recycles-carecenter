<?php

namespace App\Http\Controllers\Zendesk;

use App\Http\Controllers\Controller;
use App\Models\Comment;
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
        $ticketMetric = $client->tickets($ticketID)->metrics()->findAll()->ticket_metric;
        $ticketComments = $client->tickets($ticketID)->comments()->findAll()->comments;
        try {


            $t = Ticket::updateOrCreate([
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
                "fields_count" => count($ticket->fields),
                "comments_count" => count($ticketComments),
            ]);

            foreach ($ticket->fields as $field) {
                if ($t->fields()->where('ticketfield_id', $field->id)->exists()) {
                    $t->fields()->updateExistingPivot($field->id, ['value' => $field->value]);
                } else {
                    $t->fields()->attach($field->id, ['value' => $field->value]);
                }
            }

            foreach ($ticketComments as $comment) {
                $comment = Comment::updateOrCreate([
                    'id' => $comment->id,
                ], [
                    'ticket_id' => $ticket->id,
                    'body' => $comment->body,
                    'html_body' => $comment->html_body,
                    'plain_body' => $comment->plain_body,
                    'via' => $comment->via,
                    'attachments' => $comment->attachments,
                    'author_id' => $comment->author_id,
                    'audit_id' => $comment->audit_id,
                    'metadata' => $comment->metadata,
                    'public' => $comment->public,
                    'type' => $comment->type,
                    'created_at' => $comment->created_at,
                ]);
            }

        } catch (\Exception $exception) {

            Log::error('Ticket Update (webhook) : ' . $exception->getMessage());

        }

        return redirect()->route('support.tickets.index');
    }
}
