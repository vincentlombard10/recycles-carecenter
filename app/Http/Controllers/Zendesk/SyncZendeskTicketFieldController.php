<?php

namespace App\Http\Controllers\Zendesk;

use App\Http\Controllers\Controller;
use App\Models\Zendesk\TicketField;
use Zendesk\API\HttpClient as ZendeskAPI;

class SyncZendeskTicketFieldController extends Controller
{
    public function __invoke()
    {
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '-1');

        $client = new ZendeskAPI(config('zendesk.subdomain'));
        $client->setAuth(config('zendesk.auth_strategy'), [
            'username' => config('zendesk.username'),
            'token' => config('zendesk.token')
        ]);

        $ticketfields = $client->ticketFields()->findAll();
        foreach($ticketfields->ticket_fields as $ticketfield) {
            TicketField::updateOrCreate([
                'id' => $ticketfield->id,
            ], [
                'url' => $ticketfield->url,
                'type' => $ticketfield->type,
                'title' => $ticketfield->title,
                'raw_title' => $ticketfield->raw_title,
                'description' => $ticketfield->description,
                'raw_description' => $ticketfield->raw_description,
                'position' => $ticketfield->position,
                'active' => $ticketfield->active,
                'required' => $ticketfield->required,
                'collapsed_for_agents' => $ticketfield->collapsed_for_agents,
                'regexp_for_validation' => $ticketfield->regexp_for_validation,
                'title_in_portal' => $ticketfield->title_in_portal,
                'raw_title_in_portal' => $ticketfield->raw_title_in_portal,
                'visible_in_portal' => $ticketfield->visible_in_portal,
                'editable_in_portal' => $ticketfield->editable_in_portal,
                'required_in_portal' => $ticketfield->required_in_portal,
                'agent_can_edit' => $ticketfield->agent_can_edit,
                'tag' => $ticketfield->tag,
                'created_at' => $ticketfield->created_at,
                'updated_at' => $ticketfield->updated_at,
                'removable' => $ticketfield->removable,
                'key' => $ticketfield->key,
                'agent_description' => $ticketfield->agent_description,
            ]);
        }
    }
}
