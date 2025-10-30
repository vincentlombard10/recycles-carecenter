<?php

use App\Http\Controllers\GroupController;

Route::group([
    'prefix' => 'groups',
    'as' => 'groups.',
    'middleware' => 'auth:web'
], function () {
    Route::get('/', [GroupController::class, 'index'])->name('index');
});
