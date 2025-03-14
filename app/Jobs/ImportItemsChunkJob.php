<?php

namespace App\Jobs;

use App\Models\Brand;
use App\Models\Group;
use App\Models\Item;
use App\Models\Serial;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ImportItemsChunkJob implements ShouldQueue
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
            $this->chunk->each(function (array $row) {
                try {
                    $group = Group::firstOrCreate([
                        'code' => $row['Itm_Fam'],
                    ]);

                    $brand = Brand::firstOrCreate([
                        'code' => $row['Itm_Marque'],
                    ]);
                    $item = Item::firstOrCreate([
                        'itno' => $row['Itm_Code']
                    ], [
                        'itds' => $row['Itm_Nom'],
                        'group_code' => $row['Itm_Fam'],
                        'brand_code' => $row['Itm_Marque'],
                        'label' => $row['Itm_NomFR'],
                        'status' => $row['Itm_Stat'],
                        'brand_id' => $brand->id,
                        'group_id' => $group->id,
                    ]);

                    Serial::where('item_itno', $row['Itm_Code'])
                        ->update(['item_id' => $item->id]);

                } catch (\Exception $e) {
                    Log::error($e->getMessage());
                }
            });
        });
    }
}
