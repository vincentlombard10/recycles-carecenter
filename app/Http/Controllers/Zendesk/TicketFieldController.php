<?php

namespace App\Http\Controllers\Zendesk;

use App\Http\Controllers\Controller;
use App\Models\Zendesk\TicketField;
use Illuminate\Http\Request;
use Zendesk\API\HttpClient as ZendeskAPI;
class TicketFieldController extends Controller
{
    public function index()
    {
        $client = new ZendeskAPI(config('zendesk.subdomain'));
        $client->setAuth(config('zendesk.auth_strategy'), [
            'username' => config('zendesk.username'),
            'token' => config('zendesk.token')
        ]);

        $ticketFields = TicketField::all();

        foreach ($ticketFields as $ticketField) {
            try {
                $response = $client->ticketFields()->find($ticketField->id);
            } catch (\Exception $e) {
                $ticketField->delete();
                dump($e->getMessage());
            }
        }
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
