<?php

declare(strict_types=1);

namespace Carpatin\TableTools\Command\ArgumentConverter;

use Carpatin\TableTools\IO\GetOpt;
use Carpatin\TableTools\TableProcessor\Config\TableHeaderPrependerConfig;
use InvalidArgumentException;

class CsvHeadersPrependArgumentConverter extends PipingCompatibleArgumentConverter
{
    public static function extractTableProcessorConfig(): ?TableHeaderPrependerConfig
    {
        // extracts the h/headers option as configured through initialization
        $options = GetOpt::getParsedOptions();
        $headers = $options['h'] ?? $options['headers'];
        if (null === $headers) {
            throw new InvalidArgumentException('Headers must be provided');
        }

        return new TableHeaderPrependerConfig(explode(',', $headers));
    }

    public static function initOptions(): void
    {
        // the only getopt() option is the list of headers, comma separated, either short or long version
        GetOpt::initOptions('h:', ['headers:']);
    }
}
