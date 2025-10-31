<?php

namespace App\Console\Commands;

use App\Imports\SerialsImport;
use App\Jobs\ImportSerialsJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PHPUnit\Framework\Exception;

class ImportSerials extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'serials:import {--file=?}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importation des numéros de série';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ini_set('memory_limit', '-1');

        if ($this->option('file')) {

            $date = $this->option('file');

        } else {

            $date = $this->ask('Date du fichier à importe : (format = AAMMJJ)');

            if ($date == 'C' || $date == 'c') {
                $this->line("Opération annulée");
                return;
            }

        }

        $path = 'in/serials/';
        $file_prefix = 'SN_';
        $localFilename = 'SERIALS.csv';

        $filename = sprintf('%s%s%s.CSV', $path, $file_prefix, $date);

        try {

            $fileContents = Storage::disk('m3files-ftp')->get($filename);

            if (!$fileContents) {
                $this->error('Aucun fichier d\'ímportation à cette date.');
                return;
            }
            Storage::disk('local')->put($localFilename, $fileContents);
            ImportSerialsJob::dispatch($localFilename);

            //Excel::import(new SerialsImport, $localFilename);



        } catch (Exception $e) {

            Log::error($e->getMessage());

        }
    }
}
