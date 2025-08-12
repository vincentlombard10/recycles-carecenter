<?php

use App\Http\Controllers\TicketController;

Route::group(['prefix' => 'support', 'as' => 'support.'], function () {
    Route::group(['prefix' => 'tickets', 'as' => 'tickets.'], function () {
        Route::get('/', [TicketController::class, 'index'])->name('index');
    });
});
