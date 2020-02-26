<?php

declare(strict_types=1);

namespace Yiisoft\Db\Pdo;

use Yiisoft\Db\Expressions\ExpressionInterface;

/**
 * Class PdoValue represents a $value that should be bound to PDO with exact $type.
 *
 * For example, it will be useful when you need to bind binary data to BLOB column in DBMS:
 *
 * ```php
 * [':name' => 'John', ':profile' => new PdoValue($profile, \PDO::PARAM_LOB)]`.
 * ```
 *
 * To see possible types, check [PDO::PARAM_* constants](http://php.net/manual/en/pdo.constants.php).
 *
 * @see http://php.net/manual/en/pdostatement.bindparam.php
 */
final class PdoValue implements ExpressionInterface
{
    /**
     * @var string
     */
    private ?string $value = null;

    /**
     * @var int One of PDO_PARAM_* constants
     *
     * @see http://php.net/manual/en/pdo.constants.php
     */
    private ?int $type = null;

    /**
     * PdoValue constructor.
     *
     * @param $value
     * @param $type
     */
    public function __construct(?string $value, ?int $type)
    {
        $this->value = $value;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @return int|null
     */
    public function getType(): ?int
    {
        return $this->type;
    }
}
