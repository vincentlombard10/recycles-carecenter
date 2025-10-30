<?php

namespace App\Http\Controllers;

use App\Models\ProductReturn;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Matrix\Exception;

class DownloadProductReturnController extends Controller
{
    public function __invoke(string $identifier)
    {
        try {

            $productReturn = ProductReturn::where('identifier', $identifier)->firstOrFail();
            $pdf = PDF::loadView('pdf.product-return', ['productReturn' => $productReturn]);
            return $pdf->download(sprintf('Retour_%s.pdf', $identifier));

        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        return redirect()->back();
    }
}
