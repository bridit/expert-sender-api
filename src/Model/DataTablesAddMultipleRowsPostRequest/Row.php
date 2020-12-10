<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Model\DataTablesAddMultipleRowsPostRequest;

use Pzelant\ExpertSenderApi\Model\Column;
use Webmozart\Assert\Assert;

/**
 * Row
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class Row
{
    /**
     * @var Column[]|iterable Columns
     */
    private $columns;

    /**
     * Constructor
     *
     * @param Column[]|iterable $columns Columns
     */
    public function __construct(iterable $columns)
    {
        Assert::notEmpty($columns);
        $this->columns = $columns;
    }

    /**
     * Get columns
     *
     * @return Column[]|iterable Columns
     */
    public function getColumns()
    {
        return $this->columns;
    }

}
