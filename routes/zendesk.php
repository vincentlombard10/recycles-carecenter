<?php

use App\Http\Controllers\TicketController;
use App\Http\Controllers\Zendesk\SyncZendeskTicketController;
use App\Models\Zendesk\TicketField;
use Zendesk\API\HttpClient as ZendeskAPI;

Route::group(['prefix' => 'zendesk', 'as' => 'zendesk.'], function () {
    Route::group(['prefix' => '/tickets', 'as' => 'tickets.'], function() {
        Route::get('/import', \App\Http\Controllers\Zendesk\ImportZendeskTicketController::class)
            ->name('import');
        Route::post('/export', \App\Http\Controllers\Zendesk\ExportZendeskTicketController::class)
            ->name('export.post');
        Route::get('/sync-without-comments', \App\Http\Controllers\Zendesk\SyncZendeskTicketsWithoutCommentsController::class)
            ->name('sync-without-comments');
        Route::get('/{id}/sync', SyncZendeskTicketController::class)
            ->name('sync');
    });
    Route::group(['prefix' => '/comments', 'as' => 'comments.'], function() {
       Route::get('/import', function () {

           ini_set('max_execution_time', 3600);
           ini_set('memory_limit', '-1');

           $client = new ZendeskAPI(config('zendesk.subdomain'));
           $client->setAuth(config('zendesk.auth_strategy'), [
               'username' => config('zendesk.username'),
               'token' => config('zendesk.token'),
           ]);

           $startTime = \Carbon\Carbon::now()->subDays(2)->timestamp;
           $endTime = \Carbon\Carbon::now()->subDays(290)->timestamp;

           $comments = $client->tickets()->comments()->export(['start_time' => $startTime]);
            dd($comments);

       });
    });
    Route::group(['prefix' => '/ticketfields', 'as' => 'ticketfields.'], function() {
        Route::get('/', function () {
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
        });
    });
});
