<?php

use App\Http\Controllers\Admin\ChangelogController;

Route::group([
    'prefix' => '/admin/changelog',
    'as' => 'changelogs.',
], function() {
    Route::get('/', [ChangelogController::class, 'index'])->name('index');
    Route::get('/create', [ChangelogController::class, 'create'])->name('create');
});
