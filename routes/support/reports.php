<?php

use App\Http\Controllers\Support\ExportProductReportController;
use App\Http\Controllers\Support\ProductReportController;
use App\Models\Estimate;
use App\Models\ProductReport;
use Illuminate\Http\Request;

Route::group([
    'prefix' => 'support',
    'as' => 'support.',
    'middleware' => 'auth'
], function () {

    Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {

        Route::get('/', [ProductReportController::class, 'index'])
            ->name('index');

        Route::get('/export', [ProductReportController::class, 'export'])
            ->name('export.form');

        Route::post('/export', ExportProductReportController::class)
            ->name('export.post');

        Route::get('/{identfier}/edit', [ProductReportController::class, 'edit'])
            ->name('edit');

        Route::patch('/{identfier}', [ProductReportController::class, 'update'])
            ->name('update');

        Route::patch('/start/{identfier}', [ProductReportController::class, 'start'])
            ->name('start');

        Route::get('/{productReport}/download', \App\Http\Controllers\Support\DownloadProductReportController::class)
            ->name('download');

    });

    Route::group(['prefix' => 'estimates', 'as' => 'estimates.'], function () {
        Route::patch('/{estimate}', function (Request $request, $estimate) {
            $estimate = Estimate::find($estimate);
            $estimate->state = $request->state;
            $estimate->workflow_duration = intval($estimate->created_at->diffInSeconds(now()));
            $estimate->save();
            $estimate->report->update(['status' => ProductReport::STATUS_IN_PROGRESS]);
            return redirect()->back();
        })->name('update');
    });

});
