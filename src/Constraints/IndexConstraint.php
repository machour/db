<?php
/**
 * @link http://www.yiiframework.com/
 *
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace Yiisoft\Db\Constraints;

/**
 * IndexConstraint represents the metadata of a table `INDEX` constraint.
 *
 * @author Sergey Makinen <sergey@makinen.ru>
 *
 * @since 2.0.13
 */
class IndexConstraint extends Constraint
{
    /**
     * @var bool whether the index is unique.
     */
    public $isUnique;
    /**
     * @var bool whether the index was created for a primary key.
     */
    public $isPrimary;

    public function __construct($name, $columnNames, $isUnique, $isPrimary)
    {
        parent::__construct($name, $columnNames);
        $this->isUnique = $isUnique;
        $this->isPrimary = $isPrimary;
    }
}
