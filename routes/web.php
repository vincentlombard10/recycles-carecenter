<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProfileController;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\RecordNotFoundException;
use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/zendesk-test', function() {

    try {

        $sub = 'recyclesfrance';
        $credentials = base64_encode(config('zendesk.username') . '/token:lufyxTQLPECJAB86IgFo6Y1bI8ugjJK41vqn3TQP');
        $client = new Client(['headers' => ['Authorization' => 'Basic ' . $credentials]]);
        try {
            $response = $client->request('GET', "https://{$sub}.zendesk.com/api/v2/tickets/34296.json");
        } catch (GuzzleException $e) {
            dd($e->getMessage());
        }
        if ($response->getStatusCode() === 200) {
            return response()->json(json_decode($response->getBody()->getContents()));
/*            //$tickets = json_decode($response->getBody(), true);
            foreach ($tickets['tickets'] as $ticket) {
                echo "Ticket ID: " . $ticket['id'] . " - Subject: " . $ticket['subject'] . "\n";
            }*/
        } else {
            echo "Failed to retrieve tickets. Status Code: " . $response->getStatusCode();
        }
    } catch (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e) {
        dd($e->getMessage());
    }
});

require __DIR__.'/auth.php';
require __DIR__.'/brands.php';
require __DIR__.'/groups.php';
require __DIR__.'/items.php';
require __DIR__.'/serials.php';
require __DIR__.'/contacts.php';
require __DIR__.'/support/tickets.php';
require __DIR__.'/support/returns.php';
require __DIR__.'/support/reports.php';
require __DIR__.'/admin/customfields.php';
require __DIR__.'/zendesk.php';
require __DIR__.'/admin/users.php';
