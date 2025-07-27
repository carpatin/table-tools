<?php

declare(strict_types=1);

namespace Carpatin\TableTools\TableProcessor\Processor;

use Carpatin\TableTools\Model\DataTable;
use Carpatin\TableTools\TableProcessor\Config\TableHeaderPrependerConfig;
use Carpatin\TableTools\TableProcessor\ConfigurableInterface;
use Carpatin\TableTools\TableProcessor\TableProcessorConfigInterface;
use Carpatin\TableTools\TableProcessor\TableProcessorInterface;
use InvalidArgumentException;

class TableHeaderPrepender implements TableProcessorInterface, ConfigurableInterface
{
    private TableHeaderPrependerConfig $config;

    public function process(DataTable ...$tables): array
    {
        $results = [];
        foreach ($tables as $table) {
            $result = DataTable::createEmpty($this->config->getHeaders());
            $result->appendRowsFrom($table);
            $results[] = $result;
        }

        return $results;
    }

    public function configure(TableProcessorConfigInterface $config): static
    {
        if (!$config instanceof TableHeaderPrependerConfig) {
            throw new InvalidArgumentException('Invalid config type');
        }
        $this->config = $config;

        return $this;
    }
}