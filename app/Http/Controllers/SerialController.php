<?php

namespace App\Http\Controllers;

use App\Models\Serial;
use Illuminate\Http\Request;

class SerialController extends Controller
{
    public function index()
    {
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
