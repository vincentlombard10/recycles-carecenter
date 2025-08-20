<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Log;

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

        $rootPermissions = Permission::doesntHave('parent')
            ->orderBy('position', 'ASC')
            ->get();

        $usedPermissions = $role->permissions->modelKeys();

        return view('roles.edit', compact('role', 'rootPermissions'))
            ->withUsedPermissions($usedPermissions);
    }

    public function update(Request $request, $id)
    {
        try {
            $role = Role::find($id);
            $role->syncPermissions($request->permission);
            $role->save();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
        return redirect()->route('admin.roles.index');
    }

    public function destroy($id)
    {

    }
}
