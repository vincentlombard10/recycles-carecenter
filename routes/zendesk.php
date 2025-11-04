<?php

use App\Http\Controllers\TicketController;
use App\Http\Controllers\Zendesk\SyncZendeskTicketController;
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
    });
});
