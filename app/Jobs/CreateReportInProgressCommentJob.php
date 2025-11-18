<?php

namespace App\Jobs;

use App\Models\ProductReport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Zendesk\API\HttpClient as ZendeskAPI;

class CreateReportInProgressCommentJob implements ShouldQueue
{
    use Queueable;
    private string $username;
    private string $subdomain;
    private string $token;
    private string $auth_strategy;

    /**
     * Create a new job instance.
     */
    public function __construct(public ProductReport $productReport)
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
        $html_body = sprintf('<p>Bonjour %s</p>', $this->productReport->return->ticket->contact->name);
        $html_body.= sprintf("<p>Nous vous informons que l’expertise concernant votre dossier #%s est en cours.", $this->productReport->return->ticket->id);
        $html_body.= "<p>Notre équipe travaille activement pour analyser votre envoi et nous vous tiendrons informé(e) dès que l’examen sera terminé ou si des informations supplémentaires sont nécessaires.</p>";
        $html_body.= "<p>Nous vous remercions de votre patience et restons à votre disposition pour toute question.</p>";
        $html_body.= "<p>Le Service après-vente & Garantie</p>";

        $client = new ZendeskAPI($this->subdomain);
        $client->setAuth(config('zendesk.auth_strategy'), ['username' => $this->username, 'token' => $this->token]);
        $ticketsData = $client->tickets()->update($this->productReport->return->ticket->id, [
                'comment' => [
                    'html_body' => $html_body,
                ],
                'custom_fields' => [
                    "25438901642002" => "traitement"
                ],
                'status' => 'open',
            ]
        );
    }
}
