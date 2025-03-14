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
                    'id' =>  $contact['Cli_Code'],
                ], [
                    'name' => $contact['Cli_Nom'],
                    'status' => $contact['Cli_Sta'],
                    'address1' => $contact['Cli_Adr1'],
                    'address2' => $contact['Cli_Adr2'],
                    'postalcode' => $contact['Cli_CodePos'],
                    'city' => $contact['Cli_Ville'],
                    'country' => $contact['Cli_Pays'],
                    'phone' => $contact['Cli_Tel'],
                    'email' => $contact['Cli_Mail'],
                    'salesrep' => $contact['Cli_Rep'],
                ]);
                if($contact->addresses()->count() === 0) {
                    Address::create([
                        'name' => 'Adresse principale par défaut',
                        'address1' => $contact->address1,
                        'address2' => $contact->address2,
                        'postalcode' => $contact->postalcode,
                        'city' => $contact->city,
                        'is_primary' => true,
                        'is_active' => true,
                        'contact_id' => $contact->id,
                    ]);
                }

            } catch (Exception $e) {
                Log::error($e->getMessage());
            }
        });
    }
}
