<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Model\DataTablesDeleteRowsPostRequest;

use Bridit\ExpertSenderApi\Enum\DataTablesDeleteRowsPostRequest\FilterOperator;
use Webmozart\Assert\Assert;

/**
 * Filter for delete many rows
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class Filter
{
    /**
     * @var string Name
     */
    private $name;

    /**
     * @var string Value
     */
    private $value;

    /**
     * @var FilterOperator Operator
     */
    private $operator;

    /**
     * Constructor.
     *
     * @param string $name Name
     * @param FilterOperator $operator Operator
     * @param int|string|float $value Value
     */
    public function __construct(string $name, FilterOperator $operator, $value)
    {
        Assert::notEmpty($name);
        Assert::scalar($value);
        $this->name = $name;
        $this->value = strval($value);
        $this->operator = $operator;
    }

    /**
     * Get name
     *
     * @return string Name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get value
     *
     * @return string Value
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Get operator
     *
     * @return FilterOperator Operator
     */
    public function getOperator(): FilterOperator
    {
        return $this->operator;
    }
}
