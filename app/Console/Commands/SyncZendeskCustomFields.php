<?php

namespace App\Console\Commands;

use App\Models\Zendesk\TicketField;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Zendesk\API\HttpClient as ZendeskAPI;
class SyncZendeskCustomFields extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zendesk:sync-custom-fields';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchro des champs personnalisés Zendesk';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info("Sync Zendesk custom fields");
        $client = new ZendeskAPI(config('zendesk.subdomain'));
        $client->setAuth(config('zendesk.auth_strategy'), [
            'username' => config('zendesk.username'),
            'token' => config('zendesk.token')
        ]);

        $ticketFields = TicketField::all();

        foreach ($ticketFields as $ticketField) {
            try {
                $response = $client->ticketFields()->find($ticketField->id);
            } catch (\Exception $e) {
                $ticketField->delete();
            }
        }

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
