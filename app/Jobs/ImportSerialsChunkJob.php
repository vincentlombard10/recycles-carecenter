<?php

namespace App\Jobs;

use App\Models\Item;
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
        $this->chunk->each(function ($row) {
            try {
                $serial = Serial::updateOrCreate([
                    'code' => $row['SNH_Num']
                ], [
                    'item_itno' => $row['SNH_Art'],
                    'in' => \Carbon\Carbon::parse($row['SNH_DtIn'])->format('Y-m-d') ?? null,
                    'out' => \Carbon\Carbon::parse($row['SNH_DtOut'])->format('Y-m-d') ?? null,
                    'last_order' => $row['SNH_CdeM3'],
                    'last_delivery' => $row['SNH_BL'],
                    'dealer_code' => $row['SNH_Cli'],
                ]);
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }
        });
    }
}
