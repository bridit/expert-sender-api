<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Request;

use Pzelant\ExpertSenderApi\Enum\HttpMethod;
use Pzelant\ExpertSenderApi\RequestInterface;
use Webmozart\Assert\Assert;

/**
 * Get list of tables request
 *
 * @author Nikita Sapogov <sapogov.n@Pzelant.ru>
 */
class DataTablesGetTablesRequest implements RequestInterface
{
    /**
     * @var string|null Table name to get details
     */
    private $tableName;

    /**
     * Constructor.
     *
     * @param null|string $tableName Table name
     */
    public function __construct(?string $tableName)
    {
        if ($tableName !== null) {
            Assert::notEmpty($tableName);
        }
        $this->tableName = $tableName;
    }

    /**
     * {@inheritdoc}
     */
    public function toXml(): string
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function getQueryParams(): array
    {
        $params = [];
        if ($this->tableName !== null) {
            $params['name'] = $this->tableName;
        }

        return $params;
    }

    /**
     * {@inheritdoc}
     */
    public function getMethod(): HttpMethod
    {
        return HttpMethod::GET();
    }

    /**
     * {@inheritdoc}
     */
    public function getUri(): string
    {
        return '/v2/Api/DataTablesGetTables';
    }
}
