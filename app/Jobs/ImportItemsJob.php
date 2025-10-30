<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportItemsJob implements ShouldQueue
{
    use Queueable;

    public string $localFilename;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->localFilename = "ITEMS.csv";
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        SimpleExcelReader::create(storage_path('app/private/' . $this->localFilename))
            ->useDelimiter(";")
            ->getRows()
            ->chunk(10)
            ->each(function ($row) {
                ImportItemsChunkJob::dispatch($row);
            });
    }
}
