<?php

namespace App\Observers;

use App\Models\ProductReport;
use App\Models\ProductReturn;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Support\Facades\Log;

class ProductReportObserver implements ShouldHandleEventsAfterCommit
{
    public function saving(ProductReport $productReport)
    {
        if ($productReport->isDirty('status')) {
            $productReport->closed_at = $productReport->closed_at === null ? now() : $productReport->closed_at;
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
