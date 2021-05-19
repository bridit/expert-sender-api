<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Request;

use Bridit\ExpertSenderApi\Enum\HttpMethod;
use Bridit\ExpertSenderApi\Model\WhereCondition;
use Bridit\ExpertSenderApi\RequestInterface;
use Bridit\ExpertSenderApi\Traits\WhereConditionToXmlConverterTrait;
use Webmozart\Assert\Assert;

/**
 * Request to get count of rows in table
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class DataTablesGetDataCountRequest implements RequestInterface
{
    use WhereConditionToXmlConverterTrait;

    /**
     * @var string Table name
     */
    private $tableName;

    /**
     * @var WhereCondition[] Where conditions
     */
    private $whereConditions = [];

    /**
     * Constructor.
     *
     * @param string $tableName Table name
     * @param WhereCondition[]|array $whereConditions Where conditions
     */
    public function __construct(string $tableName, array $whereConditions)
    {
        Assert::notEmpty($tableName);
        Assert::allIsInstanceOf($whereConditions, WhereCondition::class);
        Assert::notEmpty($whereConditions);
        $this->tableName = $tableName;
        $this->whereConditions = $whereConditions;
    }

    /**
     * {@inheritdoc}
     */
    public function toXml(): string
    {
        $xmlWriter = new \XMLWriter();
        $xmlWriter->openMemory();
        $xmlWriter->writeElement('TableName', $this->tableName);
        $xmlWriter->startElement('WhereConditions');
        foreach ($this->whereConditions as $whereCondition) {
            $this->convertWhereConditionToXml($whereCondition, $xmlWriter);
        }

        $xmlWriter->endElement(); // WhereConditions

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
        return '/v2/Api/DataTablesGetDataCount';
    }
}
