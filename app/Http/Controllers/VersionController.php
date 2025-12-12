<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VersionController extends Controller
{
    public function index()
    {
        return view('versions.index');
    }

    public function create()
    {
        return view('versions.create');
    }
}
