<?php

declare(strict_types=1);

namespace Carpatin\TableTools\IO;

use Carpatin\TableTools\Model\DataTable;

class CsvReader
{
    public static function read($inputStream): DataTable
    {
        $data = [];
        while (($row = fgetcsv($inputStream, null, ',', '"', '\\')) !== false) {
            $data[] = $row;
        }

        return DataTable::createFromArray($data);
    }
}
