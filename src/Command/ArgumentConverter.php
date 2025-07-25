<?php

declare(strict_types=1);

namespace Carpatin\TableTools\Command;

use Carpatin\TableTools\TableProcessor\TableProcessorConfigInterface;

interface ArgumentConverter
{
    public static function getInputStreams(): array;

    public static function getOutputStream();

    public static function extractTableProcessorConfig(): ?TableProcessorConfigInterface;
}
