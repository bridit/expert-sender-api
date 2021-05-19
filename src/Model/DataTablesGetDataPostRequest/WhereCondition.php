<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Model\DataTablesGetDataPostRequest;

use Bridit\ExpertSenderApi\Enum\DataTablesGetDataPostRequest\Operator;

/**
 * Where condition
 *
 * @deprecated Use {@see \Bridit\ExpertSenderApi\Model\WhereCondition} instead
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class WhereCondition extends \Bridit\ExpertSenderApi\Model\WhereCondition
{
    /**
     * Constructor.
     *
     * @param string $columnName Column name
     * @param Operator $operator Operator
     * @param float|int|string $value Value
     */
    public function __construct($columnName, Operator $operator, $value)
    {
        @trigger_error('use \Bridit\ExpertSenderApi\Model\WhereCondition instead', E_USER_DEPRECATED);

        parent::__construct($columnName, $operator, $value);
    }
}
