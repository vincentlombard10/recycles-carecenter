<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\BatteryStateResource;
use App\Models\BatteryState;
use App\Http\Controllers\Controller;
class BatteryResourceController extends Controller
{
    public function index()
    {
        return BatteryStateResource::collection(BatteryState::all());
    }
}
