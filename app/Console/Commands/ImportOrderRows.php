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
        if ($this->option('file')) {

            $date = $this->option('file');

        } else {

            $date = $this->ask('Date du fichier à importe : (format = AAMMJJ)');

            if ($date == 'C' || $date == 'c') {
                $this->line("Opération annulée");
                return;
            }

        }

        $path = 'in/invoices/';
        $file_prefix = 'SI_';
        $localFilename = 'ORDER_ROWS.csv';

        $filename = sprintf('%s%s%s.CSV', $path, $file_prefix, $date);

        try {

            $fileContents = Storage::disk('sftp')->get($filename);
            $fileContents = Storage::disk('sftp')->get($filename);

            if (!$fileContents) {
                $this->error('Aucun fichier d\'ímportation à cette date.');
                return;
            }
            Storage::disk('local')->put($localFilename, $fileContents);

            Excel::import(new OrderRowsImport(), $localFilename);

        } catch (Exception $e) {

            Log::error($e->getMessage());

        }
    }
}
