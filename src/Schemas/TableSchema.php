<?php

declare(strict_types=1);

namespace Yiisoft\Db\Schemas;

use Yiisoft\Db\Exceptions\InvalidArgumentException;

/**
 * TableSchema represents the metadata of a database table.
 *
 * @property array $columnNames List of column names. This property is read-only.
 */
class TableSchema
{
    /**
     * @var string|null the name of the schema that this table belongs to.
     */
    public ?string $schemaName = null;

    /**
     * @var string the name of this table. The schema name is not included. Use {@see fullName} to get the name with
     * schema name prefix.
     */
    public string $name;

    /**
     * @var string the full name of this table, which includes the schema name prefix, if any.
     * Note that if the schema name is the same as the {@see Schema::defaultSchema|default schema name}, the schema name
     * will not be included.
     */
    public string $fullName;

    /**
     * @var array primary keys of this table.
     */
    public array $primaryKey = [];

    /**
     * @var string sequence name for the primary key. Null if no sequence.
     */
    public ?string $sequenceName = null;

    /**
     * @var array foreign keys of this table. Each array element is of the following structure:
     *
     * ```php
     * [
     *  'ForeignTableName',
     *  'fk1' => 'pk1',  // pk1 is in foreign table
     *  'fk2' => 'pk2',  // if composite foreign key
     * ]
     * ```
     */
    public array $foreignKeys = [];

    /**
     * @var ColumnSchema[] column metadata of this table. Each array element is a {@see ColumnSchema} object, indexed by
     * column names.
     */
    public array $columns = [];

    /**
     * Gets the named column metadata.
     *
     * This is a convenient method for retrieving a named column even if it does not exist.
     *
     * @param string $name column name
     *
     * @return ColumnSchema metadata of the named column. Null if the named column does not exist.
     */
    public function getColumn($name): ColumnSchema
    {
        return $this->columns[$name] ?? null;
    }

    /**
     * Returns the names of all columns in this table.
     *
     * @return array list of column names
     */
    public function getColumnNames()
    {
        return \array_keys($this->columns);
    }

    /**
     * Manually specifies the primary key for this table.
     *
     * @param string|array $keys the primary key (can be composite)
     *
     * @throws InvalidArgumentException if the specified key cannot be found in the table.
     */
    public function fixPrimaryKey($keys): void
    {
        $keys = (array) $keys;
        $this->primaryKey = $keys;

        foreach ($this->columns as $column) {
            $column->isPrimaryKey = false;
        }

        foreach ($keys as $key) {
            if (isset($this->columns[$key])) {
                $this->columns[$key]->isPrimaryKey = true;
            } else {
                throw new InvalidArgumentException("Primary key '$key' cannot be found in table '{$this->name}'.");
            }
        }
    }
}
