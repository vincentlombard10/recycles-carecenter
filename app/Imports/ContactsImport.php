<?php

namespace App\Imports;

use App\Models\Contact;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Matrix\Exception;

class ContactsImport implements ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading, WithUpserts, WithEvents
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            if ($row['cli_code'] !== 'Cli_Code' && intval($row['cli_sta']) === 20) {
                try {
                    $contact = Contact::updateOrCreate([
                        'code' => $row['cli_code'],
                    ], [
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
                    Log::info('contact', ['contact' => $contact]);
                } catch (Exception $e) {
                    Log::error($e->getMessage());
                }
            }
        }
    }
    public function batchSize(): int
    {
        return 10;
    }

    public function chunkSize(): int
    {
        return 10;
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
