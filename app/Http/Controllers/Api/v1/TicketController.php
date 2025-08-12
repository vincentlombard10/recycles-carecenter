<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        if ($request->q) {
            $tickets = Ticket::where('id', 'like', $request->q.'%')->get();
        } else {
            $tickets = Ticket::all();
        }
        return response()->json($tickets);
    }
}
