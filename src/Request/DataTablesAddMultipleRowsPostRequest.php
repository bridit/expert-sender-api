<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Request;

use Pzelant\ExpertSenderApi\Enum\HttpMethod;
use Pzelant\ExpertSenderApi\Model\DataTablesAddMultipleRowsPostRequest\Row;
use Pzelant\ExpertSenderApi\RequestInterface;
use Pzelant\ExpertSenderApi\Traits\ColumnToXmlConverterTrait;

/**
 * Request for POST DataTablesAddMultipleRows
 *
 * @author Nikita Sapogov <sapogov.n@Pzelant.ru>
 */
class DataTablesAddMultipleRowsPostRequest implements RequestInterface
{
    use ColumnToXmlConverterTrait;
    /**
     * @var string Table name
     */
    private $tableName;

    /**
     * @var Row[]|iterable Rows
     */
    private $rows;

    /**
     * Constructor
     *
     * @param string $tableName Table name
     * @param Row[]|iterable $rows Rows
     */
    public function __construct($tableName, iterable $rows)
    {
        $this->tableName = $tableName;
        $this->rows = $rows;
    }

    /**
     * {@inheritdoc}
     */
    public function toXml(): string
    {
        $xmlWriter = new \XMLWriter();
        $xmlWriter->openMemory();
        $xmlWriter->writeElement('TableName', $this->tableName);
        $xmlWriter->startElement('Data');
        foreach ($this->rows as $row) {
            $xmlWriter->startElement('Row');
            $xmlWriter->startElement('Columns');
            foreach ($row->getColumns() as $column) {
                $this->convertColumnToXml($column, $xmlWriter);
            }

            $xmlWriter->endElement(); // Columns
            $xmlWriter->endElement(); // Row
        }

        $xmlWriter->endElement(); // Data

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
        return '/v2/Api/DataTablesAddMultipleRows';
    }
}
