<?php

namespace App\Console\Commands;

use App\Imports\OrderRowsImport;
use App\Imports\SerialsImport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Matrix\Exception;

class ImportOrderRows extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:import-rows {--file=?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importation des lignes de commandes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ini_set('max_execution_time', '3600');
        ini_set('memory_limit', '-1');

        $path = 'in/invoices/';
        $file_prefix = 'SI_';
        $localFilename = 'ORDER_ROWS.csv';

        if ($this->option('m3files-ftp')) {

            $date = $this->option('file');

        } else {

            $date = $this->ask('Date du fichier à importe : (format = AAMMJJ)');

            if ($date == 'C' || $date == 'c') {
                $this->line("Opération annulée");
                return 1;
            }

        }


        $filename = sprintf('%s%s%s.CSV', $path, $file_prefix, $date);

        Log::info(sprintf("Commandes - Mise à jour des lignes à partir du fichier différentiel %s", $filename));

        try {

            $fileContents = Storage::disk('sftp')->get($filename);

            if (!$fileContents) {
                Log::warning(sprintf("Commandes - Aucun contenu dans le fichier %s", $filename));
                $this->error('Aucun fichier d\'ímportation à cette date.');
                return 1;
            }
            Storage::disk('local')->put($localFilename, $fileContents);

            Excel::import(new OrderRowsImport(), $localFilename);

        } catch (Exception $e) {

            Log::error($e->getMessage());

        }

        return 0;
    }
}
