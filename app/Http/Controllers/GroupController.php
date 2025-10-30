<?php

namespace App\Http\Controllers;

use Auth;

class GroupController extends Controller
{
    public function index()
    {
        if(!Auth::user()->canAny('groups.read')) {
            \ToastMagic::error('You do not have permission to access this page.');
            return redirect()->route('dashboard');
        }
        return view('groups.index');
    }
}
