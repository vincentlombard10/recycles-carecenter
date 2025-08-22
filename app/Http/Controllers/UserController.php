<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create')
            ->withRoles($roles);
    }

    public function store(Request $request)
    {
        try {
            $randomPassword = Str::random(10);
            $user = User::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'username' => $request->username,
                'name' => sprintf('%s %s', $request->input('firstname'), $request->input('lastname')),
                'email' => $request->input('email'),
                'password' => bcrypt($randomPassword),
                'email_verified_at' => now(),
            ]);
            $user->assignRole($request->input('role'));
            $user->save();
            \ToastMagic::success("Utilisateur créé");
        } catch (\Throwable $th) {
            \ToastMagic::error($th->getMessage());
        }
        return redirect()->route('admin.users.index');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.users.edit')
            ->withUser($user)
            ->withRoles($roles);
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);
            $user->update([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'name' => sprintf('%s %s', $request->input('firstname'), $request->input('lastname')),
                'email' => $request->email,
            ]);
            $user->syncRoles($request->input('role'));
            $user->save();
            \ToastMagic::success("Utilisateur mis à jour");
        } catch (\Throwable $th) {
            \ToastMagic::error($th->getMessage());
        }
        return redirect()->route('admin.users.index');
    }
}
