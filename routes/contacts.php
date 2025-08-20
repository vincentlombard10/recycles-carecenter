<?php

use App\Http\Controllers\ContactController;

Route::group(['prefix' => 'contacts', 'as' => 'contacts.', 'middleware' => 'auth:web'], function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::get('/search', [ContactController::class, 'search'])->name('search');
    Route::group(['prefix' => '/{id}'], function () {
        Route::get('/', [ContactController::class, 'show'])->name('show');
    });
});
