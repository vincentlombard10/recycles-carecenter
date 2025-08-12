<?php

namespace App\Helpers;

class ArrayHelpers
{
    public static function chunkFile(string $filePath, callable $generator, int $chunkSize = 100, string $separator = ';')
    {
        $file = fopen($filePath, 'r');
        $data = [];

        for ($i = 0; ($row = fgetcsv($file, null, $separator)) !== false; $i++) {

            $data[] = $generator($row);
            if ($i % $chunkSize === 0) {
                yield $data;
                $data = [];
            }
        }

        if (!empty($data)) {
            yield $data;
            $data = [];
        }

        fclose($filePath);
    }
}
