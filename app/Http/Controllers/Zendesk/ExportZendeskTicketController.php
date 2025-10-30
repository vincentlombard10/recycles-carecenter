<?php

namespace App\Http\Controllers\Zendesk;

use App\Http\Controllers\Controller;
use App\Jobs\ExportTicketsJob;
use Illuminate\Http\Request;

class ExportZendeskTicketController extends Controller
{
    public function __invoke(Request $request)
    {
        ExportTicketsJob::dispatch($request->from, $request->to);
        return redirect()->back();
    }
}
