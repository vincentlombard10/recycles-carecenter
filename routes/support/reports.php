<?php

use App\Http\Controllers\ProductReportController;

Route::group(['prefix' => 'support', 'as' => 'support.'], function () {

    Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {
        Route::get('/', [ProductReportController::class, 'index'])->name('index');
        Route::get('/{identfier}/edit', [ProductReportController::class, 'edit'])->name('edit');
        Route::patch('/{identfier}', [ProductReportController::class, 'update'])->name('update');
    });

});
