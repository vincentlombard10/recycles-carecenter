<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contacts.index');
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.show', compact('contact'));
    }

    public function search(Request $request)
    {
        $search = $request->term;
        if ($search != '') {
            $contacts = Contact::whereAny(['code', 'name'], 'like', '%' . $search . '%')->get();
        } else {
            $contacts = Contact::orderBy('code')->get();
        }
        return response()->json(['contacts' => $contacts]);
    }
}
