<?php

declare(strict_types=1);

namespace Yiisoft\Db\Expressions;

/**
 * Expression represents a DB expression that does not need escaping or quoting.
 *
 * When an Expression object is embedded within a SQL statement or fragment, it will be replaced with the
 * {@see expression} property value without any DB escaping or quoting. For example,
 *
 * ```php
 * $expression = new Expression('NOW()');
 * $now = (new \Yiisoft\Db\Querys\Query)->select($expression)->scalar();  // SELECT NOW();
 * echo $now; // prints the current date
 * ```
 *
 * Expression objects are mainly created for passing raw SQL expressions to methods of
 * {@see Query}, {@see ActiveQuery}, and related classes.
 */
class Expression implements ExpressionInterface
{
    /**
     * @var string the DB expression
     */
    public string $expression;

    /**
     * @var array list of parameters that should be bound for this expression.
     * The keys are placeholders appearing in {@see expression} and the values are the corresponding parameter values.
     */
    public array $params = [];

    /**
     * Constructor.
     *
     * @param string $expression the DB expression
     * @param array $params parameters
     */
    public function __construct(string $expression, array $params = [])
    {
        $this->expression = $expression;
        $this->params = $params;
    }

    /**
     * String magic method.
     *
     * @return string the DB expression.
     */
    public function __toString(): string
    {
        return $this->expression;
    }
}
