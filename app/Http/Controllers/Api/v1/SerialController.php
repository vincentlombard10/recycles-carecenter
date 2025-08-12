<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SerialResource;
use App\Models\Serial;
use Illuminate\Http\Request;

class SerialController extends Controller
{
    public function index(Request $request)
    {
        if($request->q) {
            $serials = Serial::where('code', 'like', '%'.$request->q.'%')->get();
        }

        return SerialResource::collection($serials);
    }
}
