<?php

namespace App\Http\Controllers;

use App\Models\CustomField;
use Devrabiul\ToastMagic\Facades\ToastMagic;

class FormFieldController extends Controller
{
    public function index()
    {
        $customfields = CustomField::with('options')->orderBy('name')->get();
        return view('admin.customfields.index', compact('customfields'));
    }

    public function edit($id)
    {
        $customfield = CustomField::findOrFail($id);
        return view('admin.customfields.edit', compact('customfield'));
    }
}
