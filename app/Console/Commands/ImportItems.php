<?php

namespace App\Console\Commands;

use App\Imports\ItemsImport;
use App\Jobs\ImportItemsJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PHPUnit\Framework\Exception;

class ImportItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'items:import {--file=?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importation des items';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ini_set('max_execution_time', '3600');
        ini_set('memory_limit', '-1');

        $path = 'in/items/';
        $file_prefix = 'IT_';
        $localFilename = 'ITEMS.csv';

        if ($this->option('file')) {

            $date = $this->option('file');

        } else {

            $date = $this->ask('Date du fichier à importe : (format = AAMMJJ)');

            if ($date == 'C' || $date == 'c') {
                $this->line("Opération annulée");
                return 1;
            }

        }

        $filename = sprintf('%s%s%s.CSV', $path, $file_prefix, $date);

        Log::info(sprintf("Items - Mise à jour des contacts à partir du fichier différentiel %s", $filename));

        $this->line("Importer le fichier $filename ...");

        try {

            $fileContents = Storage::disk('sftp')->get($filename);

            if (!$fileContents) {
                Log::warning(sprintf("Items - Aucun contenu dans le fichier %s", $filename));
                $this->error('Aucun fichier d\'ímportation à cette date.');
            }
            Storage::disk('local')->put($localFilename, $fileContents);

            ImportItemsJob::dispatch($localFilename);

        } catch (Exception $e) {

            Log::error($e->getMessage());

        }

        return 0;

    }
}
