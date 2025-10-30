<?php

namespace App\Http\Controllers;

use App\Models\ProductReport;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class DownloadProductReportController extends Controller
{
    public function __invoke($identifier)
    {
        $productReport = ProductReport::where('identifier', $identifier)->firstOrFail();
        try {

            $pdf = PDF::loadView('pdf.product-reports.product-report--' . $productReport->return->type, ['productReport' => $productReport])
                ->setOption('fontDir', public_path('/fonts'))
                ->setOption('fontCache', public_path('/fonts'));;
            return $pdf->download(sprintf('Rapport_%s.pdf', $identifier));

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
        return redirect()->back();
    }
}
