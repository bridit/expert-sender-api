<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Request;

use Pzelant\ExpertSenderApi\Enum\HttpMethod;
use Pzelant\ExpertSenderApi\RequestInterface;

/**
 * Clear table request
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class DataTablesClearTableRequest implements RequestInterface
{
    /**
     * @var string Table name
     */
    private $tableName;

    /**
     * Constructor.
     *
     * @param string $tableName Table name
     */
    public function __construct(string $tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     * {@inheritdoc}
     */
    public function toXml(): string
    {
        $xmlWriter = new \XMLWriter();
        $xmlWriter->openMemory();

        $xmlWriter->writeElement('TableName', $this->tableName);

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
        return '/v2/Api/DataTablesClearTable';
    }
}
