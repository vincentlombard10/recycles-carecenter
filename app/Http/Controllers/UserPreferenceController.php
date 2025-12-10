<?php

namespace App\Http\Controllers;

use App\Models\UserPreference;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserPreferenceController extends Controller
{
    public function update(Request $request): RedirectResponse
    {
        if($request->show_badges) {
            auth()->user()->setPreference('show_badges', $request->show_badges);
        } else {
            auth()->user()->setPreference('show_badges', false);
        }
        return redirect()->route('profile.index');
    }
}
