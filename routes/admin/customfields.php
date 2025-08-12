<?php

use App\Models\CustomFieldOption;
use Illuminate\Http\Request;

Route::group(['prefix' => 'customfields', 'as' => 'customfields.'], function () {
    Route::get('/', [\App\Http\Controllers\FormFieldController::class, 'index'])
        ->name('index');
    Route::get('/option/{field}', [\App\Http\Controllers\FormFieldOptionController::class, 'edit'])
        ->name('edit.option');
    Route::get('{formfield}/edit/', [\App\Http\Controllers\FormFieldController::class, 'edit'])
        ->name('edit');
    Route::group(['prefix' => 'options', 'as' => 'options.'], function () {
        Route::post('/sort', function(Request $request) {
            Log::info('Request', ['items' => $request->input('items')]);
            for($i = 0; $i < count($request->input('items')); $i++) {
                CustomFieldOption::where('id', $request->input('items')[$i])->update(['position' => $i]);
            }
            return response()->json($request->input('items'));
        })->name('sort');
        Route::get('/{option}', [\App\Http\Controllers\FormFieldOptionController::class, 'edit'])
            ->name('edit');
        Route::post('/', [\App\Http\Controllers\FormFieldOptionController::class, 'store'])
            ->name('store');
        Route::patch('/{option}', [\App\Http\Controllers\FormFieldOptionController::class, 'update'])
            ->name('update');
    });
});
