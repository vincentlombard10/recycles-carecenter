<?php

namespace App\Imports;

use App\Models\Item;
use App\Models\Serial;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\AfterSheet;

class SerialsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, WithUpserts, WithEvents
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if( $row['snh_num'] !== 'SNH_Num') {
            return new Serial([
                'code' => $row['snh_num'],
                'item_itno' => $row['snh_art'],
                'in' => \Carbon\Carbon::parse($row['snh_dtin'])->format('Y-m-d') ?? null,
                'out' => \Carbon\Carbon::parse($row['snh_dtout'])->format('Y-m-d') ?? null,
                'order' => $row['snh_cdem3'],
                'delivery' => $row['snh_bl'],
                'dealer_code' => $row['snh_cli'],
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
        return 'code';
    }

    public function registerEvents(): array
    {
        return [
            AfterImport::class => function(AfterImport $event) {
                $serials = Serial::select('id', 'item_itno')
                    ->whereNotNull('item_itno')
                    ->where('code', '!=', 'SNH_Num')
                    ->distinct()->get();

                foreach ($serials as $serial) {
                    $item = Item::where('itno', $serial->item_itno)->first();
                    Serial::whereId($serial->id)->update(['item_id' => $item?->id]);
                }
            },
        ];
    }
}
