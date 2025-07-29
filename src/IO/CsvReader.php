<?php

declare(strict_types=1);

namespace Carpatin\TableTools\IO;

use Carpatin\TableTools\Model\DataTable;

/**
 * Reads table data from a CSV stream to a DataTable
 */
final class CsvReader
{
    public function read($inputStream, bool $hasNoHeaders = false): DataTable
    {
        $data = [];
        while (($row = fgetcsv($inputStream, null, ',', '"', '\\')) !== false) {
            $data[] = $row;
        }

        return DataTable::createFromArray($data, $hasNoHeaders);
    }

    public function readClose(mixed $inputStream, bool $ignoreHeaders = false): DataTable
    {
        $dataTable = $this->read($inputStream, $ignoreHeaders);
        fclose($inputStream);

        return $dataTable;
    }
}
