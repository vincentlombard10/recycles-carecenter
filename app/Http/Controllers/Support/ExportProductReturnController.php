<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use App\Jobs\ExportProductReturnsJob;
use Illuminate\Http\Request;
class ExportProductReturnController extends Controller
{
    public function __invoke(Request $request)
    {
        ExportProductReturnsJob::dispatch(auth()->user(), $request->from, $request->to);

        $message = sprintf("Un fichier Excel va vous être envoyé à l'adresse %s dans quelques instants...", auth()->user()->email);

        return redirect()->back()
            ->with('success', $message);
    }
}
