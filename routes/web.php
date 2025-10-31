<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Mail\TestMail;
use App\Models\ProductReport;
use App\Models\ProductReturn;
use App\Models\Serial;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\RecordNotFoundException;
use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;

Route::middleware('guest')->get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


require __DIR__.'/auth.php';
require __DIR__.'/brands.php';
require __DIR__.'/groups.php';
require __DIR__.'/items.php';
require __DIR__.'/serials.php';
require __DIR__.'/contacts.php';
require __DIR__.'/support/tickets.php';
require __DIR__.'/support/returns.php';
require __DIR__.'/support/reports.php';
require __DIR__.'/zendesk.php';
require __DIR__.'/admin/users.php';
require __DIR__.'/webhooks.php';
