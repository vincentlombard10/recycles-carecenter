<?php

namespace App\Imports;

use App\Models\Serial;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OrderRowsImport implements ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {

            try {
                if (Serial::where('code', $row['sni_num'])->exists()) {
                    $serial = Serial::where('code', $row['sni_num'])->first();
                    echo "Serial : ".$serial->code. " - " . $row['sni_dtfact'] . "\n";
                    $serial->update([
                        'last_order' => $row['sni_cde'],
                        'last_delivery' => $row['sni_bl'],
                        'last_invoice' => $row['sni_fact'],
                        'last_invoice_date' => $row['sni_dtfact'] > $serial->last_invoice_date ? $row['sni_dtfact'] : $serial->last_invoice_date,
                    ]);
                }
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }
        }
    }

    public function batchSize(): int
    {
        return 50;
    }

    public function chunkSize(): int
    {
        return 50;
    }
}
