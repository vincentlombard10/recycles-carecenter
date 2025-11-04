<?php

namespace App\Listeners;

use App\Events\TicketsExported;
use App\Mail\TicketsExportMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TIcketsExportedListener
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
    public function handle(TicketsExported $event): void
    {
        Log::info('TIckets Exported Listener');
        try {

            $mailData = [
                'subject' => 'Nouvelle exportation de tickets',
                'files' => [
                    $event->filename
                ]
            ];

            Mail::to($event->user->email)
                ->send(new TicketsExportMail($mailData));

        } catch (\Exception $exception) {

            Log::error($exception->getMessage());

        }
    }
}
