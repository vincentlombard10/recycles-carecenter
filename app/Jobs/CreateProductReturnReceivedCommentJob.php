<?php

namespace App\Jobs;

use App\Models\ProductReturn;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Zendesk\API\HttpClient as ZendeskAPI;
class CreateProductReturnReceivedCommentJob implements ShouldQueue
{
    use Queueable;

    private string $username;
    private string $subdomain;
    private string $token;
    private string $auth_strategy;

    /**
     * Create a new job instance.
     */
    public function __construct(public ProductReturn $productReturn)
    {
        ini_set('max_execution_time', 360);
        ini_set('memory_limit', '-1');

        $this->username = config('zendesk.username');
        $this->subdomain = config('zendesk.subdomain');
        $this->token = config('zendesk.token');
        $this->auth_strategy = config('zendesk.auth_strategy');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $html_body = sprintf('<p>Bonjour %s</p>', $this->productReturn->ticket->contact->name);
        $html_body.= sprintf("<p>Nous vous confirmons que nous avons bien reçu votre colis concernant le dossier %s.</p>", $this->productReturn->ticket->id);
        $html_body.= "<p>Notre équipe va maintenant procéder à l’examen de votre envoi et vous tiendra informé(e) des prochaines étapes dès que possible.</p>";
        $html_body.= "<p>Si vous avez des questions supplémentaires ou des informations à ajouter concernant votre dossier, n’hésitez pas à répondre à ce message.</p>";
        $html_body.= "<p>Nous vous remercions pour votre confiance.</p>";

        $client = new ZendeskAPI($this->subdomain);
        $client->setAuth(config('zendesk.auth_strategy'), ['username' => $this->username, 'token' => $this->token]);
        $ticketsData = $client->tickets()->update($this->productReturn->ticket->id, [
                'comment' => [
                    'html_body' => $html_body,
                ],
                'custom_fields' => [
                    "25438901642002" => "reception"
                ],
                'status' => 'open',
            ]
        );
    }
}
