<?php

namespace App\Observers;

use App\Jobs\CreateReportInProgressCommentJob;
use App\Models\Estimate;
use App\Models\ProductReport;
use App\Models\ProductReturn;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Support\Facades\Log;

class ProductReportObserver implements ShouldHandleEventsAfterCommit
{
    public function saving(ProductReport $productReport)
    {
        if ($productReport->isDirty('status')) {
            switch ($productReport->status) {
                case 'init':
                    $productReport->status = 'init';
                    break;
                case 'pending':
                    $productReport->status = 'pending';
                    break;
                case 'in_progress':
                    Log::info('Démarrage de l\'expertise', ['report' => $productReport]);
                    $productReport->status = 'in_progress';
                    $productReport->started_at = $productReport->started_at == null ? now() : $productReport->started_at;
                    CreateReportInProgressCommentJob::dispatch($productReport);
                    break;
                case 'paused':
                    $estimate = Estimate::create([
                        'file' => request()->file('estimate')->getClientOriginalName(),
                        'productreport_id' => $productReport->id
                    ]);
                    break;
                case 'closed':
                    $productReport->status = 'closed';
                    $productReport->closed_at = $productReport->closed_at == null ? now() : $productReport->closed_at;
                    break;
                default:
            }
        }
        Log::debug('Product report saving', ['productReport' => $productReport]);
    }

    public function updated(ProductReport $productReport)
    {
        if ($productReport->isDirty('status') && $productReport->isClosed()) {
            $productReport->closed_at = $productReport->closed_at === null ? now() : $productReport->closed_at;
        }
        Log::debug('Product report updated', ['productReport' => $productReport]);
    }

    public function deleted(ProductReport $productReport)
    {
        Log::debug('Product report deleted', ['productReport' => $productReport]);
    }

    public function restored(ProductReport $productReport)
    {
        Log::debug('Product report restored', ['productReport' => $productReport]);
    }

    public function forceDeleted(ProductReport $productReport)
    {
        Log::debug('Product report forceDeleted', ['productReport' => $productReport]);
    }
}
