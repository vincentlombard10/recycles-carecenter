<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomFieldResource;
use App\Models\CustomField;

class CustomFieldController extends Controller
{
    public function index()
    {
        $collection = CustomFieldResource::collection(CustomField::all());
        return response()->json($collection, 200);
    }

    public function show(string $customField)
    {
        $customField = new CustomFieldResource(CustomField::findOrFail($customField));
        return response()->json($customField, 200);
    }
}
