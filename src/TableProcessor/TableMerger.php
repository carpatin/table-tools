<?php

declare(strict_types=1);

namespace Carpatin\TableTools\TableProcessor;

use Carpatin\TableTools\Model\DataTable;
use Carpatin\TableTools\TableProcessorInterface;
use Illuminate\Support\Arr;

class TableMerger implements TableProcessorInterface
{
    public function process(DataTable ...$tables): DataTable
    {
        $collector = DataTable::createEmpty(Arr::first($tables)->getColumnNames());
        foreach ($tables as $table) {
            $collector->appendRowsFrom($table);
        }

        return $collector;
    }

    public function configure(?TableProcessorConfigInterface $config): static
    {
        // no need now for extra config
        return $this;
    }
}
