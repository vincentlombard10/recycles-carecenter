<?php

namespace App\Console\Commands;

use App\Jobs\ImportContactsJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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
        ini_set('memory_limit', '4096M');
        ini_set('max_execution_time', '3600');

        if ($this->option('file')) {

            $date = $this->option('file');

        } else {

            $date = $this->ask('Date du fichier à importe : (format = AAMMJJ)');

            if ($date == 'C' || $date == 'c') {
                $this->line("Opération annulée");
                return;
            }

        }

        $path = 'in/users/';
        $file_prefix = 'CL_';
        $localFilename = 'CONTACTS.csv';

        $filename = sprintf('%s%s%s.CSV', $path, $file_prefix, $date);

        try {

            $fileContents = Storage::disk('m3files-ftp')->get($filename);
            Log::debug('FileContents', ['contents' =>$fileContents]);

            if (!$fileContents) {
                $this->error('Aucun fichier d\'ímportation à cette date.');
                return;
            } else {
                $this->line("ok");
            }
            Storage::disk('local')->put($localFilename, $fileContents);
            ImportContactsJob::dispatch($localFilename);

        } catch (Exception $e) {

            $this->error($e->getMessage());
            Log::error($e->getMessage());

        }
    }
}
