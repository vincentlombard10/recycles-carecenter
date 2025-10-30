<?php

use App\Http\Controllers\SerialController;

Route::group([
    'prefix' => 'serials',
    'as' => 'serials.',
    'middleware' => 'auth:web'
], function () {
    Route::get('/', [SerialController::class, 'index'])->name('index');
    Route::get('/orphans', [SerialController::class, 'orphans'])->name('orphans');
    Route::get('/search', [SerialController::class, 'search'])->name('search');
});
