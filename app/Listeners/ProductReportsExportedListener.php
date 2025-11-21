<?php

namespace App\Listeners;

use App\Events\ProductReportsExported;
use App\Mail\ProductReportsExportMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ProductReportsExportedListener
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
    public function handle(ProductReportsExported $event): void
    {
        Log::info('ProductReportsExported >>> handle');

        try {

            $mailData = [
                'subject' => 'Nouvelle exportation de rapports d\'intervention',
                'files' => [
                    $event->filename
                ]
            ];

            Mail::to($event->user->email)
                ->send(new ProductReportsExportMail($mailData));

        } catch (\Exception $exception) {

            Log::error($exception->getMessage());

        }
    }
}
