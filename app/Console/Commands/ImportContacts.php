<?php

namespace App\Console\Commands;

use App\Imports\ContactsImport;
use App\Jobs\ImportContactsJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PHPUnit\Framework\Exception;

class ImportContacts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contacts:import {--file=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importation des contacts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ini_set('max_execution_time', '3600');

        $path = 'in/users/';
        $file_prefix = 'CL_';
        $localFilename = 'CONTACTS.csv';

        if ($this->option('file')) {

            $date = $this->option('file');

        } else {

            $date = $this->ask('Date du fichier à importe : (format = AAMMJJ)');

            if ($date == 'C' || $date == 'c') {
                $this->line("Opération annulée");
                return;
            }

        }

        $filename = sprintf('%s%s%s.CSV', $path, $file_prefix, $date);

        Log::info(sprintf("Contacts - Mise à jour des contacts à partir du fichier différentiel %s", $filename));
        try {

            $fileContents = Storage::disk('m3files-ftp')->get($filename);

            if (!$fileContents) {
                Log::warning(sprintf("Contacts - Aucun contenu dans le fichier %s", $filename));
                $this->error('Aucun fichier d\'ímportation à cette date.');
                return;
            } else {
                $this->line("ok");
            }
            Storage::disk('local')->put($localFilename, $fileContents);
            Excel::import(new ContactsImport(), $localFilename);

        } catch (Exception $e) {

            $this->error($e->getMessage());
            Log::error($e->getMessage());

        }

        return 0;
    }
}
