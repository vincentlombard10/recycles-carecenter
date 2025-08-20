<?php

use App\Http\Controllers\ProductReturnController;

Route::group(['prefix' => 'support', 'as' => 'support.'], function () {
    Route::group(['prefix' => 'returns', 'as' => 'returns.'], function () {
        Route::get('/', [ProductReturnController::class, 'index'])
            ->name('index');
        Route::get('/create', [ProductReturnController::class, 'create'])
            ->name('create');
        ROute::get('/archives', [ProductReturnController::class, 'trash'])->name('trash');
        Route::delete('/{productReturn}', [ProductReturnController::class, 'destroy'])
            ->name('destroy');
        Route::get('/{productReturn}', [ProductReturnController::class, 'show'])->name('show');
        Route::get('/{productReturn}/download', \App\Http\Controllers\DownloadProductReportController::class)->name('download');

        Route::get('/{productReturn}/edit', [ProductReturnController::class, 'edit'])->name('edit');
        Route::patch('/{productReturn}', [ProductReturnController::class, 'update'])->name('update');
        Route::post('/', [ProductReturnController::class, 'store'])->name('store');
        Route::post('/{productReturn}/restore', [ProductReturnController::class, 'restore'])->name('restore');
        Route::delete('/{productReturn}/forceDelete', [ProductReturnController::class, 'forceDelete'])->name('forceDelete');
    });
});
