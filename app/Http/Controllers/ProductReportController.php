<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class ProductReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function create()
    {
        return view('reports.create');
    }

    public function store(Request $request)
    {
    }

    public function edit($id)
    {
        return view('reports.edit');
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id): RedirectResponse
    {
        return redirect()->route('reports.index');
    }
}
