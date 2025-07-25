<?php

declare(strict_types=1);

namespace Carpatin\TableTools;

use Carpatin\TableTools\Model\DataTable;
use Carpatin\TableTools\TableProcessor\TableProcessorConfigInterface;

interface TableProcessorInterface
{
    public function process(DataTable ...$tables): DataTable;

    public function configure(?TableProcessorConfigInterface $config): static;
}
