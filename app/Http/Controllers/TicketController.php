<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TicketController extends Controller
{
    public function index()
    {
        return view('tickets.index');
    }

    public function show(string $zendeskID)
    {
        try {
            $ticket = Ticket::find($zendeskID);
            return view('tickets.show', compact('ticket'));
        } catch (ModelNotFoundException $e) {

        }
    }
}
