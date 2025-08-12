<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductReportResource;
use App\Models\ProductReport;

class ProductReportController extends Controller
{
    public function show(string $identifier)
    {
        return new ProductReportResource(ProductReport::where('identifier', $identifier)->firstOrFail());
    }
}
