<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Request;

use Bridit\ExpertSenderApi\Enum\HttpMethod;
use Bridit\ExpertSenderApi\Model\DataTablesDeleteRowsPostRequest\Filter;
use Bridit\ExpertSenderApi\RequestInterface;
use Webmozart\Assert\Assert;

/**
 * Request to delete rows
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class DataTablesDeleteRowsPostRequest implements RequestInterface
{
    /**
     * @var string Table name
     */
    private $tableName;

    /**
     * @var Filter[] Filters. This is an equivalent of SQL "WHERE" directive.
     */
    private $filters;

    /**
     * Constructor.
     *
     * @param string $tableName Table name
     * @param Filter[] $filters Filters. This is an equivalent of SQL "WHERE" directive
     */
    public function __construct(string $tableName, array $filters)
    {
        Assert::notEmpty($tableName);
        Assert::allIsInstanceOf($filters, Filter::class);
        $this->tableName = $tableName;
        $this->filters = $filters;
    }

    /**
     * {@inheritdoc}
     */
    public function toXml(): string
    {
        $xmlWriter = new \XMLWriter();
        $xmlWriter->openMemory();
        $xmlWriter->writeElement('TableName', $this->tableName);
        $xmlWriter->startElement('Filters');
        foreach ($this->filters as $filter) {
            $xmlWriter->startElement('Filter');
            $xmlWriter->startElement('Column');
            $xmlWriter->writeElement('Name', $filter->getName());
            $xmlWriter->writeElement('Operator', $filter->getOperator()->getValue());
            $xmlWriter->writeElement('Value', $filter->getValue());
            $xmlWriter->endElement(); // Column
            $xmlWriter->endElement(); // Filter
        }

        $xmlWriter->endElement(); // Filters

        return $xmlWriter->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getQueryParams(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getMethod(): HttpMethod
    {
        return HttpMethod::POST();
    }

    /**
     * {@inheritdoc}
     */
    public function getUri(): string
    {
        return '/v2/Api/DataTablesDeleteRows/';
    }
}
