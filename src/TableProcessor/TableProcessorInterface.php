<?php

declare(strict_types=1);

namespace Carpatin\TableTools\TableProcessor;

use Carpatin\TableTools\Model\DataTable;

interface TableProcessorInterface
{
    /**
     * @return array|DataTable[]
     */
    public function process(DataTable ...$tables): array;
}
