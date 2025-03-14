<?php

namespace App\Jobs;

use App\Models\Serial;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ImportSerialsChunkJob implements ShouldQueue
{
    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    public int $uniqueFor = 3600;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public $chunk
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->chunk->each(function (array $row) {
            try {
                $serial = Serial::firstOrCreate([
                    'code' => $row['SNH_Num']
                ], [
                    'item_itno' => $row['SNH_Art'],
                    'in' => $row['SNH_DtIn'],
                    'out' => $row['SNH_DtOut'],
                    'customer_code' => $row['SNH_Cli'],
                    'order' => $row['SNH_CdeM3'],
                    'delivery' => $row['SNH_BL'],
                    'item_id' => null
                ]);
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        });
    }
}
