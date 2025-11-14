<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChangeLog;
use Illuminate\Http\Request;

class ChangelogController extends Controller
{
    public function index()
    {
        return view('admin.changelog.index');
    }

    public function create()
    {
        return view('admin.changelog.create');
    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {
        $changelog = ChangeLog::findOrFail($id);
        return view('admin.changelog.show')
            ->with('changelog', $changelog);
    }

    public function edit($id)
    {
        return view('admin.changelog.edit');
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
