<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportSerialsJob implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $localFilename;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->localFilename = 'SERIALS.csv';
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        SimpleExcelReader::create(storage_path(sprintf('app/private/%s', $this->localFilename)))
            ->useDelimiter(";")
            ->getRows()
            ->chunk(10)
            ->each(function ($chunk) {
                ImportSerialsChunkJob::dispatch($chunk);
            });
    }
}
