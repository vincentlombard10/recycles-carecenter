<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProductReportController;
use App\Http\Controllers\ProductReturnController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SerialController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => 'support', 'as' => 'support.'], function () {
        Route::group(['prefix' => 'tickets', 'as' => 'tickets.'], function () {
            Route::get('/', [TicketController::class, 'index'])->name('index');
        });

        Route::group(['prefix' => 'returns', 'as' => 'returns.'], function () {
            Route::get('/', [ProductReturnController::class, 'index'])->name('index');
            Route::get('/create', [ProductReturnController::class, 'create'])->name('create');
            Route::post('/', [ProductReturnController::class, 'store'])->name('store');
        });

        Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {
            Route::get('/', [ProductReportController::class, 'index'])->name('index');
        });
    });

    Route::group(['prefix' => 'serials', 'as' => 'serials.'], function () {
        Route::get('/', [SerialController::class, 'index'])->name('index');
        Route::get('/search', [SerialController::class, 'search'])->name('search');
    });

    Route::group(['prefix' => 'brands', 'as' => 'brands.'], function () {
        Route::get('/', [BrandController::class, 'index'])->name('index');
    });

    Route::group(['prefix' => 'groups', 'as' => 'groups.'], function () {
        Route::get('/', [GroupController::class, 'index'])->name('index');
    });

    Route::group(['prefix' => 'items', 'as' => 'items.'], function () {
        Route::get('/', [ItemController::class, 'index'])->name('index');
        Route::get('/search', [ItemController::class, 'search'])->name('search');
    });

    Route::group(['prefix' => 'contacts', 'as' => 'contacts.'], function () {
        Route::get('/', [ContactController::class, 'index'])->name('index');
        Route::get('/search', [ContactController::class, 'search'])->name('search');
        Route::group(['prefix' => '/{id}'], function () {
            Route::get('/', [ContactController::class, 'show'])->name('show');
        });
    });
});

require __DIR__.'/auth.php';
