<?php

namespace App\Http\Controllers\Zendesk;

use App\Http\Controllers\Controller;
use App\Jobs\ExportTicketsJob;
use Illuminate\Http\Request;

class ExportZendeskTicketController extends Controller
{
    public function __invoke(Request $request)
    {
        ExportTicketsJob::dispatch(auth()->user(), $request->from, $request->to);

        $message = sprintf("Un fichier Excel va vous être envoyé à l'adresse %s dans quelques instants...", auth()->user()->email);

        return redirect()->back()
            ->with('success', $message);
    }
}
