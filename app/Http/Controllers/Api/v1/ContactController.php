<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController
{
    public function index(Request $request)
    {
        if($request->q) {
            $contacts = Contact::query()->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->q . '%');
                $query->orWhere('code', 'like', '%' . $request->q . '%');
            })->get();
        } else {
            $items = Contact::all();
        }
        return ContactResource::collection($contacts);
    }
}
