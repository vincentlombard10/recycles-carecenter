<?php

use App\Http\Controllers\BrandController;

Route::group(['prefix' => 'brands', 'as' => 'brands.'], function () {
    Route::get('/', [BrandController::class, 'index'])->name('index');
});
