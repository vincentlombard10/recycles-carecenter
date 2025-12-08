<?php

namespace App\Http\Controllers;

use App\Models\CustomField;
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
        $tickets_new = Ticket::query()->where('status', 'new')->count();
        $tickets_open = Ticket::query()->where('status', 'open')->count();
        $tickets_hold = Ticket::query()->where('status', 'hold')->orWhere('status', 'pending')->count();
        return view('tickets.index')
            ->with('tickets_new', $tickets_new)
            ->with('tickets_open', $tickets_open)
            ->with('tickets_hold', $tickets_hold);
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
        $ticket_fields = CustomField::all();
        return view('tickets.export')
            ->with('start_time', $start_time)
            ->with('end_time', $end_time)
            ->with('ticket_fields', $ticket_fields);
    }
}
