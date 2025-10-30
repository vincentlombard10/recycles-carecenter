<?php

use App\Http\Controllers\TicketController;

Route::group([
    'prefix' => 'support',
    'as' => 'support.',
    'middleware' => 'auth'
], function () {
    Route::group(['prefix' => 'tickets', 'as' => 'tickets.'], function () {
        Route::get('/', [TicketController::class, 'index'])
            //>middleware('can:tickets.oulala')
            ->name('index');
        Route::get('/export', [TicketController::class, 'export'])->name('export.form');
        Route::get('/{zendeskID}', [TicketController::class, 'show'])->name('show');
    });
});
