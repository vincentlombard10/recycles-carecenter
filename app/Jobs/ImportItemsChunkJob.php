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
        $this->chunk->each(function ($row) {
            Log::info(sprintf("Row : %s", $row));
            $brand = Brand::firstOrNew([
                'code' => $row['Itm_Marque'],
            ]);

            $group = Group::firstOrNew([
                'code' => $row['Itm_Fam'],
            ]);

            $item = Item::updateOrCreate([
                'itno' => $row['Itm_Code'],
            ], [
                'itds' => $row['Itm_Nom'],
                'label' => $row['Itm_NomFR'],
                'group_id' => $group->id ?? null,
                'group_code' => $row['Itm_Fam'],
                'brand_id' => $brand->id ?? null,
                'brand_code' => $row['Itm_Marque'],
            ]);

            Serial::where('item_itno', $item->itno)->update([
                'item_id' => $item->id ?? null,
            ]);
        });
    }
}
