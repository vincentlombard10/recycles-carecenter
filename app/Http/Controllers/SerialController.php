<?php

namespace App\Http\Controllers;

use App\Models\Serial;
use Illuminate\Http\Request;

class SerialController extends Controller
{
    public function index()
    {
        $serials = Serial::paginate(25);
        return view('serials.index', compact('serials'));
    }

    public function search(Request $request)
    {
        $search = $request->serial;
        $serial = Serial::where('code', $search)->first();
        return response()->json(["serial" => $serial]);
    }
}
