<?php

namespace App\Observers;

use App\Helpers\AlphacodeHelper;
use App\Jobs\CreateProductReturnReceivedCommentJob;
use App\Models\ProductReport;
use App\Models\ProductReturn;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Support\Facades\Log;

class ProductReturnObserver implements ShouldHandleEventsAfterCommit
{
    public function creating(ProductReturn $productReturn): void
    {
        $productReturn->identifier = AlphacodeHelper::generateCode(6);
        $productReturn->author_id = auth()->user()->id;
    }
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
        if ($productReturn->isDirty('status')
            && $productReturn->isPending()
            && $productReturn->validated_at === null
        ) {
            $productReturn->validated_at = now();
            $productReturn->validator_id = auth()->user()->id;
        }

        if  (
            $productReturn->isDirty('status') &&
            $productReturn->isReceived() &&
            $productReturn->received_at === null
        ){
            Log::debug('ProductReturn updated status', ['productReturn' => $productReturn]);

            if ($productReturn->ticket->contact) {
                CreateProductReturnReceivedCommentJob::dispatch($productReturn);
            } else {
                Log::debug('ProductReturn updated ticket contact', ['productReturn' => $productReturn]);
            }
            /*
             * TODO: créer un commentaire Zendesk Support au ticket associé
             * + changement du statut du ticket à OUVERT (open)
             * + changement du statut du retour à Réception (reception)
             */

        }
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
