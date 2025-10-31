<?php

use App\Webhooks\Jobs\UpdateOrCreateTicketWebhookJob;

return [
    'configs' => [
        [
            'name' => 'zendesk.tickets',
            'signing_secret' => 'gMJ_lF2Mc_8S2R5D3u7MxRYyjdOuBhJhU-5TwLYbTsc=',
            'signature_header_name' => 'X-Zendesk-Webhook-Signature',
            'signature_validator' => \App\Webhooks\Validators\ZendeskSignatureValidator::class,
            'webhook_profile' => \Spatie\WebhookClient\WebhookProfile\ProcessEverythingWebhookProfile::class,
            'webhook_response' => \App\Webhooks\Responses\UpdateOrCreateTicketWebhookResponse::class,
            'webhook_model' => \Spatie\WebhookClient\Models\WebhookCall::class,
            'store_headers' => [],
            'process_webhook_job' => UpdateOrCreateTicketWebhookJob::class,
        ],
    ],

    /*
     * The integer amount of days after which models should be deleted.
     *
     * It deletes all records after 30 days. Set to null if no models should be deleted.
     */
    'delete_after_days' => 30,

    /*
     * Should a unique token be added to the route name
     */
    'add_unique_token_to_route_name' => false,
];
