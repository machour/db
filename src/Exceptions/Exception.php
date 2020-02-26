<?php

declare(strict_types=1);

namespace Yiisoft\Db\Exceptions;

/**
 * Exceptions represents an exception that is caused by some DB-related operations.
 */
class Exception extends \Exception
{
    /**
     * @var array the error info provided by a PDO exception. This is the same as returned
     * by [PDO::errorInfo](http://www.php.net/manual/en/pdo.errorinfo.php).
     */
    public ?array $errorInfo;

    /**
     * Constructor.
     *
     * @param string $message PDO error message
     * @param array|null $errorInfo PDO error info
     * @param int $code PDO error code
     * @param \Exception $previous  The previous exception used for the exception chaining.
     */
    public function __construct(string $message, ?array $errorInfo = [], int $code = 0, \Exception $previous = null)
    {
        $this->errorInfo = $errorInfo;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string readable representation of exception
     */
    public function __toString(): string
    {
        return parent::__toString() . PHP_EOL .
            'Additional Information:' . PHP_EOL . print_r($this->errorInfo, true);
    }
}
