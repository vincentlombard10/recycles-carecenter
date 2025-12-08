<?php

namespace App\Http\Controllers\Zendesk;

use App\Http\Controllers\Controller;
use App\Models\Zendesk\TicketField;
use Illuminate\Http\Request;

class TicketFieldController extends Controller
{
    public function index()
    {
        $ticketFields = TicketField::all();
        return view('zendesk.fields.index')
            ->with('ticket_fields', $ticketFields);
    }

    public function updateAll(Request $request)
    {
        $fields = $request->except('_token', '_method');
        TicketField::query()->update(['is_exportable' => false]);
        foreach ($fields as $key => $value) {
            TicketField::whereId($key)->update(['is_exportable' => true]);
        }
        return redirect()->back();
    }
}
