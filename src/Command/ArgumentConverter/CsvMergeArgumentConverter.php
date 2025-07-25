<?php

declare(strict_types=1);

namespace Carpatin\TableTools\Command\ArgumentConverter;

use Carpatin\TableTools\Command\ArgumentConverter;
use Carpatin\TableTools\TableProcessor\Config\TableMergerConfig;

class CsvMergeArgumentConverter implements ArgumentConverter
{
    public static function getInputStreams(): array
    {
        // TODO: temporary implementation below
        $a = [
            ['name', 'age', 'occupation'],
            ['Dan', 38, 'Developer'],
        ];
        $sa = fopen('php://memory', 'wb');
        foreach ($a as $row) {
            fputcsv($sa, $row, ',', '"', '\\');
        }
        rewind($sa);

        $b = [
            ['name', 'age', 'occupation'],
            ['Mihai', 31, 'Tester'],
        ];
        $sb = fopen('php://memory', 'wb');
        foreach ($b as $row) {
            fputcsv($sb, $row, ',', '"', '\\');
        }
        rewind($sb);

        return [$sa, $sb];
    }

    public static function getOutputStream()
    {
        return STDOUT;
    }

    public static function extractTableProcessorConfig(): ?TableMergerConfig
    {
        // TODO: return an object of TableMergerConfig if necessary
        return null;
    }
}
