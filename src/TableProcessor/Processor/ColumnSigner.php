<?php

declare(strict_types=1);

namespace Carpatin\TableTools\TableProcessor\Processor;

use Carpatin\TableTools\Model\DataTable;
use Carpatin\TableTools\Model\DataTableRow\DataRow;
use Carpatin\TableTools\TableProcessor\Config\ColumnSignerConfig;
use Carpatin\TableTools\TableProcessor\ConfigurableInterface;
use Carpatin\TableTools\TableProcessor\TableProcessorConfigInterface;
use Carpatin\TableTools\TableProcessor\TableProcessorInterface;
use InvalidArgumentException;

class ColumnSigner implements TableProcessorInterface, ConfigurableInterface
{
    private ColumnSignerConfig $config;

    public function process(DataTable ...$tables): array
    {
        $columnForSignature = $this->config->getSignatureColumn();
        $outputTables = [];
        foreach ($tables as $inputTable) {
            $inputHeaderRow = $inputTable->getHeaderRow();
            if ($inputHeaderRow->isDefault()) {
                throw new InvalidArgumentException('Input table must have a header row');
            }
            // create a new immutable header row for the result table including the column for the signature
            $resultHeaderRow = $inputHeaderRow->withAddedColumn($columnForSignature);
            // create the result table with the prepared headers
            $resultTable = DataTable::createEmpty($resultHeaderRow);
            /** @var DataRow $inputRow */
            foreach ($inputTable->getDataRowsIterator() as $inputRow) {
                // get the value and sign it for each of the input table rows
                $inputValue = $inputRow->getColumn($this->config->getColumn());
                openssl_sign($inputValue, $signature, $this->config->getPrivateKey(), OPENSSL_ALGO_SHA256);
                $base64Signature = base64_encode($signature);
                // create a new immutable data row that includes the signature for the column in the added column
                $resultRow = $inputRow->withAddedColumn($columnForSignature, $base64Signature);
                $resultTable->appendRow($resultRow);
            }
            $outputTables[] = $resultTable;
        }

        return $outputTables;
    }

    public function configure(TableProcessorConfigInterface $config): static
    {
        if (!$config instanceof ColumnSignerConfig) {
            throw new InvalidArgumentException('Invalid config type');
        }
        $this->config = $config;

        return $this;
    }
}
