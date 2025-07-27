<?php

declare(strict_types=1);

namespace Carpatin\TableTools\TableProcessor\Config;

use Carpatin\TableTools\TableProcessor\TableProcessorConfigInterface;

readonly class TableHeaderPrependerConfig implements TableProcessorConfigInterface
{
    public function __construct(
        private array $headers,
    ) {
        //
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }
}
