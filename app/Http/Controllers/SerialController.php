<?php

namespace App\Http\Controllers;

use App\Models\Serial;
use Auth;
use Illuminate\Http\Request;

class SerialController extends Controller
{
    public function index()
    {
        if(!Auth::user()->can('serials.read')) {
            \ToastMagic::error('You do not have permission to access this page.');
            return redirect()->route('dashboard');
        }
        $orphans = Serial::doesntHave('item')->count();
        return view('serials.index', compact( 'orphans'));
    }

    public function orphans()
    {
        return view('serials.orphans');
    }

    public function search(Request $request)
    {
        $search = $request->serial;
        $serial = Serial::where('code', $search)->first();
        return response()->json(["serial" => $serial]);
    }
}
