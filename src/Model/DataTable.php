<?php

declare(strict_types=1);

namespace Carpatin\TableTools\Model;

use Ds\Deque;
use Ds\Vector;
use Illuminate\Support\Arr;
use IteratorAggregate;
use Traversable;
use Webmozart\Assert\Assert;

class DataTable implements IteratorAggregate
{
    /**
     * Collection of rows in the data table.
     * @var Deque<DataRow>
     */
    private Deque $rows;

    private function __construct(
        /**
         * The column names of the data table.
         * @var Vector<string>
         */
        private readonly Vector $columnNames,
    ) {
        $this->rows = new Deque();
    }

    /**
     * Factory method that creates an empty data table.
     */
    public static function createEmpty(array|Vector $columnNames): static
    {
        if (!$columnNames instanceof Vector) {
            $columnNames = new Vector($columnNames);
        }

        return new static($columnNames);
    }

    /**
     * Factory method that creates a data table from a plain two-dimensional array.
     */
    public static function createFromArray(array $table): static
    {
        // we can safely create an instance for a non-empty input
        Assert::notEmpty($table);

        // handle the header row, if present
        $candidateHeaders = array_shift($table);
        $validHeaders = Arr::where($candidateHeaders, static fn($header) => is_string($header));
        if (count($validHeaders) === count($candidateHeaders)) {
            // we identified what seems to be a valid headers row, will use them
            $columnNames = new Vector($validHeaders);
        } else {
            // as fallback, we use the numeric keys as column names
            $columnNames = new Vector(array_map(static fn($value) => (string)$value, array_keys($candidateHeaders)));
        }

        // create the data table and populate with rows
        $instance = new static(new Vector($columnNames));
        foreach ($table as $row) {
            $instance->appendRow(DataRow::fromArray($row, $instance));
        }

        return $instance;
    }

    public function getIterator(): Traversable
    {
        return $this->rows->getIterator();
    }

    public function getColumnNames(): Vector
    {
        return $this->columnNames;
    }

    public function appendRow(DataRow $dataRow): static
    {
        $this->rows->push($dataRow);

        return $this;
    }

    public function appendRowsFrom(DataTable $table): static
    {
        Assert::true($this->isMergeableWith($table), 'Tables are not compatible');

        foreach ($table as $row) {
            $this->appendRow($row);
        }

        return $this;
    }

    private function isMergeableWith(DataTable $table): bool
    {
        // two tables are mergeable only when they have the same columns in the same order
        return $this->columnNames->toArray() === $table->columnNames->toArray();
    }
}
