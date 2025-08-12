<?php

namespace App\Observers;

use App\Models\ProductReport;
use App\Models\ProductReturn;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Support\Facades\Log;

class ProductReturnObserver implements ShouldHandleEventsAfterCommit
{
    public function created(ProductReturn $productReturn)
    {
        Log::debug('ProductReturn created', ['productReturn' => $productReturn]);
        try {
            ProductReport::create([
                'identifier' => $productReturn->identifier,
                'return_id' => $productReturn->id,
                'status' => ProductReport::STATUS_PENDING,
                'reason' => $productReturn->reason,
            ]);
        } catch (\Exception $exception) {
            Log::debug($exception->getMessage());
        }
    }

    public function updated(ProductReturn $productReturn)
    {
        Log::debug('ProductReturn updated', ['productReturn' => $productReturn]);
    }

    public function deleted(ProductReturn $productReturn)
    {
        Log::debug('ProductReturn deleted', ['productReturn' => $productReturn]);
    }

    public function restored(ProductReturn $productReturn)
    {
        Log::debug('ProductReturn restored', ['productReturn' => $productReturn]);
    }

    public function forceDeleted(ProductReturn $productReturn)
    {
        Log::debug('ProductReturn forceDeleted', ['productReturn' => $productReturn]);
    }
}
