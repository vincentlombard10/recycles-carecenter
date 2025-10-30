<?php

use App\Http\Controllers\BrandController;

Route::group([
    'prefix' => 'brands',
    'as' => 'brands.',
    'middleware' => 'auth'
], function () {
    Route::get('/', [BrandController::class, 'index'])->name('index');
});
