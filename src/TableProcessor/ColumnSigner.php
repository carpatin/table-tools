<?php

declare(strict_types=1);

namespace Carpatin\TableTools\TableProcessor;

use Carpatin\TableTools\Model\DataTable;
use Carpatin\TableTools\TableProcessorInterface;

class ColumnSigner implements TableProcessorInterface
{
    public function process(DataTable ...$tables): DataTable
    {
        // TODO: Implement process() method.
        return DataTable::createEmpty([]);
    }

    public function configure(?TableProcessorConfigInterface $config): static
    {
        // TODO: Implement configure() method.
        return $this;
    }
}
