<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
class ProfileController extends Controller
{
    public function index()
    {

    }

    public function updatePassword(Request $request)
    {
        $user = request()->user();

        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'confirmed'],
        ]);

        if (! Hash::check($request->current_password, $user->password)) {
            \ToastMagic::error("Your current password does not matches with the password you provided. Please try again.");
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        $request->session()->regenerate();

        \ToastMagic::success("Mot de pass modifié");

        return back()->with('status', 'Mot de passe modifié avec succès ✅');

    }
}
