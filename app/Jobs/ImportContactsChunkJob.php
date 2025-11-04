<?php

namespace App\Jobs;

use App\Models\Address;
use App\Models\Contact;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
class ImportContactsChunkJob implements ShouldQueue
{
    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    public int $uniqueFor = 3600;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public $chunk
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->chunk->each(function ($contact) {
            try {

                $contact = Contact::updateOrCreate([
                    'code' =>  $contact['Cli_Code'],
                ], [
                    'name' => $contact['Cli_Nom'],
                    'status' => $contact['Cli_Sta'],
                    'address1' => $contact['Cli_Adr1'],
                    'address2' => $contact['Cli_Adr2'],
                    'postcode' => $contact['Cli_CodePos'],
                    'city' => $contact['Cli_Ville'],
                    'country' => $contact['Cli_Pays'],
                    'phone' => $contact['Cli_Tel'],
                    'email' => $contact['Cli_Mail'],
                    'salesrep' => $contact['Cli_Rep'],
                ]);

            } catch (Exception $e) {
                Log::error($e->getMessage());
            }
        });
    }
}
