<?php

declare(strict_types=1);

namespace Carpatin\TableTools\IO;

use Carpatin\TableTools\Model\DataRow;
use Carpatin\TableTools\Model\DataTable;

class CsvWriter
{
    public static function write(DataTable $table, $outputStream): void
    {
        /** @var DataRow $row */
        foreach ($table as $row) {
            fputcsv($outputStream, $row->toArray(), ',', '"', '\\');
        }
    }
}