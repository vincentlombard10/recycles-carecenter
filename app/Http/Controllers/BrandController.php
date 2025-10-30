<?php

namespace App\Http\Controllers;

use Auth;

class BrandController extends Controller
{
    public function index()
    {
        if(!Auth::user()->canAny('brands.read')) {
            \ToastMagic::error('You do not have permission to access this page.');
            return redirect()->route('dashboard');
        }
        return view('brands.index');
    }
}
