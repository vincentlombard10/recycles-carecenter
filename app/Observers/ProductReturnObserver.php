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
                'type' => $productReturn->type,
                'productreturn_id' => $productReturn->id,
                'status' => ProductReport::STATUS_INIT,
                'reason' => $productReturn->reason,
            ]);
        } catch (\Exception $exception) {
            Log::debug($exception->getMessage());
        }
    }

    public function updating(ProductReturn $productReturn)
    {
        $productReturn->offered_at = $productReturn->isDirty('status') &&
            $productReturn->status === ProductReturn::STATUS_PENDING &&
            $productReturn->offered_at === null ? now() : $productReturn->offered_at;
    }

    public function updated(ProductReturn $productReturn)
    {
        Log::debug('ProductReturn updated', ['productReturn' => $productReturn]);
        $productReturn->report()->update([
            'type' => $productReturn->type,
        ]);
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
