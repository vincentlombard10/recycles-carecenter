 <?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'as' => 'api.v1.'], function () {
    Route::apiResource('/items', \App\Http\Controllers\Api\v1\ItemController::class);
    Route::apiResource('/tickets', \App\Http\Controllers\Api\v1\TicketController::class);
    Route::apiResource('/serials', \App\Http\Controllers\Api\v1\SerialController::class);
    Route::apiResource('/reports', \App\Http\Controllers\Api\v1\ProductReportController::class);
    Route::apiResource('/contacts', \App\Http\Controllers\Api\v1\ContactController::class);
    Route::group(['prefix' => '/batteries'], function () {
        Route::apiResource('/states', \App\Http\Controllers\Api\v1\BatteryResourceController::class);
    });
    Route::get('/custom-fields', [\App\Http\Controllers\Api\v1\CustomFieldController::class, 'index']);
    Route::get('/custom-fields/{id}', [\App\Http\Controllers\Api\v1\CustomFieldController::class, 'show']);
});
