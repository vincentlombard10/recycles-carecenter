<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Matrix\Exception;

class ContactController extends Controller
{
    public function index()
    {
        if(!Auth::user()->canAny('contacts.read')) {
            \ToastMagic::error('You do not have permission to access this page.');
            return redirect()->route('dashboard');
        }
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
