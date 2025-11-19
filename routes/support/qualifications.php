<?php

Route::group([
    'prefix' => '/qualifications',
    'as' => 'qualifications.',
    'middleware' => ['auth'],
], function () {
    Route::get('/', [\App\Http\Controllers\QualificationController::class, 'index'])
        ->name('index');
    Route::get('/create', [\App\Http\Controllers\QualificationController::class, 'create'])
        ->name('create');
    Route::post('/', [\App\Http\Controllers\QualificationController::class, 'store'])
        ->name('store');
    Route::get('/{qualification}/edit', [\App\Http\Controllers\QualificationController::class, 'edit'])
        ->name('edit');
});
