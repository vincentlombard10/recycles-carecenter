<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

Route::prefix('admin/users')->as("admin.users.")->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('update');
});

Route::prefix('admin/roles')->as("admin.roles.")->group(function () {
    Route::get('/', [RoleController::class, 'index'])->name('index');
    Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('edit');
    Route::patch('/{role}/update', [RoleController::class, 'update'])->name('update');
});

