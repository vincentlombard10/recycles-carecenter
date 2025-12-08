<?php

use App\Http\Controllers\TicketController;
use App\Http\Controllers\Zendesk\SyncZendeskTicketController;
use App\Models\Contact;
use App\Models\CustomField;
use App\Models\Ticket;
use App\Models\Zendesk\TicketField;
use Zendesk\API\HttpClient as ZendeskAPI;

Route::group(['prefix' => 'zendesk', 'as' => 'zendesk.'], function () {
    Route::group(['prefix' => '/tickets', 'as' => 'tickets.'], function () {
        Route::get('/import', \App\Http\Controllers\Zendesk\ImportZendeskTicketController::class)
            ->name('import');
        Route::post('/export', \App\Http\Controllers\Zendesk\ExportZendeskTicketController::class)
            ->name('export.post');
        Route::get('/sync-without-comments', \App\Http\Controllers\Zendesk\SyncZendeskTicketsWithoutCommentsController::class)
            ->name('sync-without-comments');
        ROute::get('/sync-missing-tickets', \App\Http\Controllers\Zendesk\SyncMissingZendeskTicketController::class)
            ->name('sync-missing-tickets');
        Route::get('/sync-fields', \App\Http\Controllers\Zendesk\SyncZendeskTicketFieldController::class)
            ->name('sync-fields');
        Route::get('/{id}/sync', SyncZendeskTicketController::class)
            ->name('sync');
        Route::get('/{id}/apply-macro/{macro}', function (int $id, string $macro) {
            ini_set('max_execution_time', 360);
            ini_set('memory_limit', '-1');
            $subdomain = config('zendesk.subdomain');
            $username = 'melvin.nion@re-cycles-france.fr';
            $token = config('zendesk.token');

            $ticket = "39053";
            $macro = 30872845447058;

            $comment = sprintf("<p>Bonjour %s,</p><p>&nbsp;</p><p>Nous vous confirmons que nous avons bien reçu votre colis concernant le dossier #%s", $ticket, $ticket);

            $client = new ZendeskAPI($subdomain);
            $client->setAuth(config('zendesk.auth_strategy'), ['username' => $username, 'token' => $token]);

            $ticketsData = $client->tickets()->update($ticket, [
                   'comment' => [
                        'body' => 'We have changed your ticket priority to Urgent and will keep you up-to-date asap.'
                    ],
                    'custom_fields' => [
                        "25438901642002" => "reexpedition"
                    ],
                    'status' => 'hold',
                    'macro_id' => $macro,
                    'author_id' => 373359407040
                ]
            );
            dd($ticketsData);

        });
    });
    Route::group(['prefix' => '/users', 'as' => 'users.'], function () {
        Route::get('/sync', function () {

            ini_set('max_execution_time', 360);
            ini_set('memory_limit', '-1');

            $contacts = Contact::whereNull('zendesk_user_id')
                ->whereNull('support_enabled')
                ->limit('500')
                ->get();

            $subdomain = config('zendesk.subdomain');
            $username = config('zendesk.username');
            $token = config('zendesk.token');

            $client = new ZendeskAPI($subdomain);
            $client->setAuth(config('zendesk.auth_strategy'), ['username' => $username, 'token' => $token]);

            foreach ($contacts as $contact) {
                $query = $client->users()->search(['query' => $contact->code]);
                if ($query->count === 0) {
                    $contact->update(['support_enabled' => false]);
                    dump(sprintf("%s : aucun utilisateur Zendesk trouvé.", $contact->code));
                } else if ($query->count === 1) {
                    dump(sprintf("%s : utilisateur Zendesk trouvé (%s).", $contact->code, $query->users[0]->id));
                    $contact->update(['support_enabled' => true, 'zendesk_user_id' => $query->users[0]->id]);
                    Ticket::where('requester_id', $query->users[0]->id)->update(['contact_id' => $contact->id]);
                } else {
                    dump(sprintf("%s : plusieurs utilisateurs Zendesk peuvent correspondre.", $contact->code));
                    $contact->update(['support_enabled' => false, 'duplicates' => $query->users]);
                }
            }
        });
    });
    Route::group(['prefix' => '/fields', 'as' => 'fields.'], function () {
        Route::get('/', function() {
            $exportable_fields = CustomField::query()->where('is_exportable', true)->pluck('title')->toArray();
            dd($exportable_fields);
        });
    });
});
