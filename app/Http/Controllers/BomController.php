<?php

namespace App\Http\Controllers;

class BomController extends Controller
{
    public function index()
    {
        return view('boms.index');
    }
}
