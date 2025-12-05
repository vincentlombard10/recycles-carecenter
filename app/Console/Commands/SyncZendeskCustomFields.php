<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncZendeskCustomFields extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zendesk:sync-custom-fields';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchro des champs personnalisés Zendesk';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info("Sync Zendesk custom fields");
    }
}
