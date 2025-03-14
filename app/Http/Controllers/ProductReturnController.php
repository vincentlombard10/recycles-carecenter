<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductReturnController extends Controller
{
    public function index()
    {
        return view('returns.index');
    }

    public function create()
    {
        return view('returns.create');
    }

    public function store(Request $request): RedirectResponse
    {
        dd($request->all());
    }

    public function show($id)
    {
        return view('returns.show');
    }

    public function update(Request $request, $id)
    {
        return view('returns.update');
    }

    public function destroy($id)
    {
    }
}
