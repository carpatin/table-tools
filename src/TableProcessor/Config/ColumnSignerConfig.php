<?php

declare(strict_types=1);

namespace Carpatin\TableTools\TableProcessor\Config;

use Carpatin\TableTools\TableProcessor\TableProcessorConfigInterface;
use OpenSSLAsymmetricKey;

readonly class ColumnSignerConfig implements TableProcessorConfigInterface
{
    public function __construct(
        private string $column,
        private string $signatureColumn,
        private OpenSSLAsymmetricKey $privateKey,
    ) {
        //
    }

    public function getColumn(): string
    {
        return $this->column;
    }

    public function getSignatureColumn(): string
    {
        return $this->signatureColumn;
    }

    public function getPrivateKey(): OpenSSLAsymmetricKey
    {
        return $this->privateKey;
    }
}
