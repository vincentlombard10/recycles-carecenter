<?php

use App\Http\Controllers\ProductReportController;

Route::group([
    'prefix' => 'support',
    'as' => 'support.',
    'middleware' => 'auth'
], function () {

    Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {

        Route::get('/', [ProductReportController::class, 'index'])
            ->name('index');

        Route::get('/{identfier}/edit', [ProductReportController::class, 'edit'])
            ->name('edit');

        Route::patch('/{identfier}', [ProductReportController::class, 'update'])
            ->name('update');

        Route::patch('/start/{identfier}', [ProductReportController::class, 'start'])
            ->name('start');

        Route::get('/{productReport}/download', \App\Http\Controllers\DownloadProductReportController::class)
            ->name('download');

    });

});
