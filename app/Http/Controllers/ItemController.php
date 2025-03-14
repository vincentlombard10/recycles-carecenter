<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::paginate(20);
        return view('items.index', compact('items'));
    }

    public function search(Request $request)
    {
        $search = $request->itno;
        $item = Item::where('itno', $search)->first();
        return response()->json(["item" => $item]);
    }
}
