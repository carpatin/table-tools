<?php

declare(strict_types=1);

namespace Carpatin\TableTools\IO;

use Carpatin\TableTools\Model\DataTable;
use Carpatin\TableTools\Model\DataTableRow\DataRow;
use Carpatin\TableTools\Model\DataTableRow\HeaderRow;

/**
 * Writes table data from a DataTable to a CSV stream
 */
final class CsvWriter
{
    public static function write(DataTable $table, $outputStream): void
    {
        /** @var DataRow|HeaderRow $row */
        foreach ($table as $row) {
            fputcsv($outputStream, $row->toArray(), ',', '"', '\\');
        }
    }

    public static function writeClose(DataTable $table, $outputStream): void
    {
        self::write($table, $outputStream);
        fclose($outputStream);
    }
}