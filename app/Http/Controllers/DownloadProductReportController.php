<?php

namespace App\Http\Controllers;

use App\Models\ProductReport;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class DownloadProductReportController extends Controller
{
    public function __invoke(ProductReport $productReport)
    {
        try {

            $pdf = Pdf::loadView('pdf.product-return');
            return $pdf->download('test.pdf');

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
        return redirect()->back();
    }
}
