<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TicketController extends Controller
{
    public function index()
    {
        if(!Auth::user()->can('tickets.read')) {
            \ToastMagic::error('You do not have permission to access this page.');
            return redirect()->route('dashboard');
        }
        return view('tickets.index');
    }

    public function show(string $zendeskID)
    {
        if(!Auth::user()->can('tickets.read')) {
            \ToastMagic::error('You do not have permission to access this page.');
            return redirect()->route('dashboard');
        }
        try {
            $ticket = Ticket::find($zendeskID);
            return view('tickets.show', compact('ticket'));
        } catch (ModelNotFoundException $e) {

        }
    }

    public function export()
    {
        $start_time = now()->subMonth()->startOfMonth();
        $end_time = now()->subMonth()->endOfMonth();
        return view('tickets.export')
            ->with('start_time', $start_time)
            ->with('end_time', $end_time);
    }
}
