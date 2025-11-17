<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstimateController extends Controller
{
    public function index()
    {
        return view('estimate.index');
    }

    public function edit($id)
    {
        return view('estimate.edit');
    }

    public function update(Request $request, $id)
    {
        
    }
}
