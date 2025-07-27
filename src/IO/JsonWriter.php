<?php

declare(strict_types=1);

namespace Carpatin\TableTools\IO;

use Carpatin\TableTools\Model\DataTable;
use Carpatin\TableTools\Model\DataTableRow\DataRow;
use JsonException;

class JsonWriter
{
    /**
     * @throws JsonException
     */
    public static function write(DataTable $table, $outputStream): void
    {
        $keys = $table->getHeaderRow()->toArray();
        $skipHeaders = !$table->getHeaderRow()->isDefault();
        /** @var DataRow $row */
        foreach ($table as $row) {
            if ($skipHeaders) {
                $skipHeaders = false;
                continue;
            }
            $object = array_combine($keys, $row->toArray());
            fwrite($outputStream, json_encode($object, JSON_THROW_ON_ERROR).PHP_EOL);
        }
    }

    public static function writeClose(DataTable $table, $outputStream): void
    {
        self::write($table, $outputStream);
        fclose($outputStream);
    }
}