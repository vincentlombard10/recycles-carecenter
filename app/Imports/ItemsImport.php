<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\Group;
use App\Models\Item;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Events\AfterImport;

class ItemsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, WithUpserts, WithEvents
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $brand = Brand::firstOrNew([
            'code' => $row['itm_marque'],
        ]);

        if ($row['itm_code'] !== 'Itm_Code') {
            return new Item([
                'itno' => $row['itm_code'],
                'itds' => $row['itm_nom'],
                'label' => $row['itm_nomfr'],
                'group_code' => $row['itm_fam'],
                'brand_code' => $row['itm_marque'],
                //'status' => intval($row['itm_stat']),
            ]);
        }
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function uniqueBy()
    {
        return 'itno';
    }

    public function registerEvents(): array
    {
        return [
            AfterImport::class => function (AfterImport $event) {

                // Mise à jour des marques associées
                $items = Item::select('brand_code')
                    ->whereNotNull('brand_code')
                    ->where('brand_code', '!=', 'Itm_Marque')
                    ->distinct()->get();

                foreach( $items as $item ){
                    echo $item->brand_code."\n";
                    $brand = Brand::updateOrCreate(['code' => $item->brand_code], ['code' => $item->brand_code]);
                    Item::where('brand_code', $item->brand_code)->update(['brand_id' => $brand->id]);
                }

                // Mise à jour des groupes associés
                $items = Item::select('group_code')
                    ->whereNotNull('group_code')
                    ->where('group_code', '!=', 'Itm_Fam')
                    ->distinct()->get();

                foreach( $items as $item ){
                    $group = Group::updateOrCreate(['code' => $item->group_code], ['code' => $item->group_code]);
                    Item::where('group_code', $item->group_code)->update(['group_id' => $group->id]);
                }
            }
        ];
    }
}
