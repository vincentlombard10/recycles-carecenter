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
    protected $signature = 'serials:import
        {date : Date du fichier à récupérer}';
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
        ini_set('max_execution_time', '3600');
        ini_set('memory_limit', '-1');

        $path = 'in/serials/';
        $file_prefix = 'SN_';
        $localFilename = 'SERIALS.csv';

        $date = $this->argument('date') ?? now()->format('ymd');

        $filename = sprintf('%s%s%s.CSV', $path, $file_prefix, $date);

        Log::info(sprintf("SN Chassis - Mise à jour à partir du fichier différentiel %s", $filename));

        try {

            $fileContents = Storage::disk('sftp')->get($filename);

            if ($fileContents) {

                Storage::disk('local')->put($localFilename, $fileContents);
                ImportSerialsJob::dispatch($localFilename);

            } else {

                Log::warning(sprintf("SN Chassis - Aucun contenu dans le fichier %s", $filename));
                $this->error('Aucun fichier d\'ímportation à cette date.');

            }

        } catch (Exception $e) {

            Log::error($e->getMessage());

        }

        return 0;
    }
}
