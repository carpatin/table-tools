<?php

declare(strict_types=1);

namespace Carpatin\TableTools\IO;

use Carpatin\TableTools\Model\DataTable;

/**
 * Reads table data from a CSV stream to a DataTable
 */
class CsvReader
{
    public static function read($inputStream, bool $ignoreHeaders = false): DataTable
    {
        $data = [];
        while (($row = fgetcsv($inputStream, null, ',', '"', '\\')) !== false) {
            $data[] = $row;
        }

        return DataTable::createFromArray($data, $ignoreHeaders);
    }

    public static function readClose(mixed $inputStream, bool $ignoreHeaders = false): DataTable
    {
        $dataTable = self::read($inputStream, $ignoreHeaders);
        fclose($inputStream);

        return $dataTable;
    }
}
