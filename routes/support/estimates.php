<?php

Route::group([
    'middleware' => 'auth',
    'prefix' => '/support/estimates',
    'as' => 'support.estimates.'
], function () {
    Route::get('/', [\App\Http\Controllers\Support\EstimateController::class, 'index'])
        ->name('index');
});
