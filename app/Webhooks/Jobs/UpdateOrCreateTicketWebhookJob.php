<?php

namespace App\Webhooks\Jobs;

use App\Domains\Auth\Models\User;
use App\Domains\Library\Models\Serial;
use App\Domains\Support\Models\Ticket;
use App\Notifications\ZendeskUserWithoutExternalIdNotification;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob;
use Spatie\WebhookClient\Models\WebhookCall;

class UpdateOrCreateTicketWebhookJob extends ProcessWebhookJob
{
    public function __construct(public WebhookCall $webhookCall)
    {
        parent::__construct($webhookCall);
    }

    public function handle(): void
    {

        Log::debug('Ticket Payload', ['payload' => $this->webhookCall->payload]);

        try {

            $ticket = Ticket::updateOrCreate([
                'zendesk_id' => $this->webhookCall->payload['id']
            ], [

            ]);

            //Log::debug('New support', ['support' => (new Ticket())->getSupport($this->webhookCall->payload['support'])]);

        } catch (Exception $e) {

            Log::error('Ticket Update (webhook) : ' . $e->getMessage());

        }

    }


}
