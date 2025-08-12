<?php

use App\Http\Controllers\ItemController;

Route::group(['prefix' => 'items', 'as' => 'items.'], function () {
    Route::get('/', [ItemController::class, 'index'])->name('index');
    Route::get('/search', [ItemController::class, 'search'])->name('search');
});
