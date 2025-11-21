<?php

namespace App\Listeners;

use App\Events\ProductReturnsExported;
use App\Mail\ProductReturnsExportMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ProductReturnsExportedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProductReturnsExported $event): void
    {
        Log::info('ProductReturnsExported >>> handle');

        try {

            $mailData = [
                'subject' => 'Nouvelle exportation de retours',
                'files' => [
                    $event->filename
                ]
            ];

            Mail::to($event->user->email)
                ->send(new ProductReturnsExportMail($mailData));

        } catch (\Exception $exception) {

            Log::error($exception->getMessage());

        }
    }
}
