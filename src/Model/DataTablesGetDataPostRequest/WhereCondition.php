<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Model\DataTablesGetDataPostRequest;

use Pzelant\ExpertSenderApi\Enum\DataTablesGetDataPostRequest\Operator;

/**
 * Where condition
 *
 * @deprecated Use {@see \Pzelant\ExpertSenderApi\Model\WhereCondition} instead
 *
 * @author Nikita Sapogov <sapogov.n@Pzelant.ru>
 */
class WhereCondition extends \Pzelant\ExpertSenderApi\Model\WhereCondition
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
        @trigger_error('use \Pzelant\ExpertSenderApi\Model\WhereCondition instead', E_USER_DEPRECATED);

        parent::__construct($columnName, $operator, $value);
    }
}
