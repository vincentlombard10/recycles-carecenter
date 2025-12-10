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
        $role_permission = Permission::select('id', 'name')->groupBy('name')->get();
        $custom_permission = array();

        foreach ($role_permission as $permission) {
            $key = substr($permission->name, 0, strpos($permission->name, '.'));
            if (str_starts_with($permission->name, $key)) {
                $custom_permission[$key][] = $permission;
            }
        }
        return view('roles.create')
            ->with('permissions', $custom_permission);
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

            $toast_message = sprintf("Le rôle %s a correctement été mis à jour.", $role->public_name);
            \ToastMagic::success($toast_message);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
        return redirect()->route('admin.roles.index');
    }

    public function destroy($id)
    {

    }
}
