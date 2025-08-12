<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        if($request->q) {
            $items = Item::where('itno', 'like', '%'.$request->q.'%')->get();
        } else {
            $items = Item::all();
        }
        return response()->json($items);
    }
}
