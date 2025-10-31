<?php

namespace App\Webhooks\Jobs;

use Exception;
use Illuminate\Support\Facades\Log;
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

        $subdomain = "recyclesfrance";
        $username = "maxime.freydrich@re-cycles-france.fr";
        $token = "silDCW7ZUFDRo6oMqfXQ8oiaSq6Lij4zzxki3gSc";

        $client = new ZendeskAPI($subdomain);
        $client->setAuth('basic', ['username' => $username, 'token' => $token]);

        try {

            Log::alert("Webhook Process Job");

/*            $ticket = Ticket::updateOrCreate([
                'zendesk_id' => $this->webhookCall->payload['id']
            ], [

            ]);*/

            //Log::debug('New support', ['support' => (new Ticket())->getSupport($this->webhookCall->payload['support'])]);

        } catch (Exception $e) {

            Log::error('Ticket Update (webhook) : ' . $e->getMessage());

        }

    }


}
