<?php

declare(strict_types=1);

namespace Carpatin\TableTools\Command;

use Carpatin\TableTools\TableProcessor\ColumnReorderer;
use Carpatin\TableTools\TableProcessor\ColumnSignatureVerifier;
use Carpatin\TableTools\TableProcessor\ColumnSigner;
use Carpatin\TableTools\TableProcessor\TableHeaderPrepender;
use Carpatin\TableTools\TableProcessor\TableMerger;
use Carpatin\TableTools\TableProcessorInterface;
use Ds\Map;

class CommandProcessorLocator
{
    private const array COMMANDS_TO_CLASSES = [
        'csv-column-reorder'     => ColumnReorderer::class,
        'csv-column-sign'        => ColumnSigner::class,
        'csv-column-sign-verify' => ColumnSignatureVerifier::class,
        'csv-headers-prepend'    => TableHeaderPrepender::class,
        'csv-merge'              => TableMerger::class,
    ];

    private Map $processors;

    public function __construct()
    {
        $this->processors = new Map();
    }

    public function getProcessorByTag(string $tag): TableProcessorInterface
    {
        if ($this->processors->hasKey($tag)) {
            return $this->processors[$tag];
        }
        $class = self::COMMANDS_TO_CLASSES[$tag];
        $this->processors[$tag] = new $class();

        return $this->processors[$tag];
    }
}
