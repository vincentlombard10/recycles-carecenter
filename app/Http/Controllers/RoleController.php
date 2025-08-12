<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleController extends Controller
{
    public function index()
    {
        return view('roles.index');
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {

    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::whereNull('parent_id')->orderBy('position', 'ASC')->get();
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
