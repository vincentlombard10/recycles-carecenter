<?php

namespace App\Imports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class ContactsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, WithUpserts, WithEvents
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row['cli_code'] !== 'Cli_Code' && intval($row['cli_sta']) === 20) {
            return new Contact([
                'code' => $row['cli_code'],
                'name' => $row['cli_nom'],
                'email' => $row['cli_mail'],
                'status' => intval($row['cli_sta']) ?? null,
                'address1' => $row['cli_adr1'],
                'address2' => $row['cli_adr2'],
                'postcode' => $row['cli_codepos'],
                'city' => $row['cli_ville'],
                'country' => $row['cli_pays'],
                'phone' => $row['cli_tel'],
                'salesrep' => $row['cli_rep'],
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
        return [];
    }
}
