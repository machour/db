<?php
/**
 * @link http://www.yiiframework.com/
 *
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace Yiisoft\Db\Constraints;

/**
 * DefaultValueConstraint represents the metadata of a table `DEFAULT` constraint.
 *
 * @author Sergey Makinen <sergey@makinen.ru>
 *
 * @since 2.0.13
 */
class DefaultValueConstraint extends Constraint
{
    /**
     * @var mixed default value as returned by the DBMS.
     */
    public $value;

    public function __construct($value, $columnNames = null, $name = null)
    {
        parent::__construct($columnNames, $name);
        $this->value = $value;
    }
}
