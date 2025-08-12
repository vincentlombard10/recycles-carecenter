<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

Route::prefix('admin/users')->as("admin.users.")->group( function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
});

Route::prefix('admin/roles')->as("admin.roles.")->group( function () {
   Route::get('/', [RoleController::class, 'index'])->name('index');
   Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('edit');
});
