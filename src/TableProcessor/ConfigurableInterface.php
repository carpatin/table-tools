<?php

declare(strict_types=1);

namespace Carpatin\TableTools\TableProcessor;

interface ConfigurableInterface
{
    public function configure(TableProcessorConfigInterface $config): static;
}
