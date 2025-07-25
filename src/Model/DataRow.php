<?php

declare(strict_types=1);

namespace Carpatin\TableTools\Model;

use Ds\Map;
use Webmozart\Assert\Assert;

class DataRow
{
    private function __construct(
        private Map $row,
    ) {
        //
    }

    public static function fromArray(array $rowValues, DataTable $table): static
    {
        $columnNames = $table->getColumnNames();
        Assert::eq(count($rowValues), $columnNames->count());

        $rowData = new Map();
        foreach (array_values($rowValues) as $i => $columnValue) {
            $rowData[$columnNames[$i]] = $columnValue;
        }

        return new static($rowData);
    }

    public function toArray(): array
    {
        return $this->row->values()->toArray();
    }
}
