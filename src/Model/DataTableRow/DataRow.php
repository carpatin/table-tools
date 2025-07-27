<?php

declare(strict_types=1);

namespace Carpatin\TableTools\Model\DataTableRow;

use Carpatin\TableTools\Model\DataTable;
use Carpatin\TableTools\Model\DataTableRow;
use Ds\Map;
use Webmozart\Assert\Assert;

/**
 * Models a data table data row.
 */
class DataRow extends DataTableRow
{
    private function __construct(
        private readonly Map $row,
    ) {
        //
    }

    public static function fromArray(array $rowValues, DataTable $table): static
    {
        $headerRow = $table->getHeaderRow();
        Assert::eq(count($rowValues), $headerRow->count());

        $rowData = new Map();
        foreach (array_values($rowValues) as $i => $columnValue) {
            $rowData[$headerRow[$i]] = $columnValue;
        }

        return new static($rowData);
    }

    public function toArray(): array
    {
        return $this->row->values()->toArray();
    }
}
