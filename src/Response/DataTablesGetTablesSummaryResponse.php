<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Response;

use Pzelant\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use Pzelant\ExpertSenderApi\Model\DataTablesGetTablesSummaryResponse\TableSummary;
use Pzelant\ExpertSenderApi\SpecificXmlMethodResponse;

/**
 * Response with tables summary
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class DataTablesGetTablesSummaryResponse extends SpecificXmlMethodResponse
{
    /**
     * Get tables
     *
     * @return TableSummary[]|iterable Tables
     */
    public function getTables(): iterable
    {
        if (!$this->isOk()) {
            throw TryToAccessDataFromErrorResponseException::createFromResponse($this);
        }

        $xml = $this->getSimpleXml();
        $nodes = $xml->xpath('/ApiResponse/TableList/Tables/Table');
        foreach ($nodes as $node) {
            yield new TableSummary(
                intval($node->Id),
                strval($node->Name),
                intval($node->ColumnsCount),
                intval($node->RelationshipsCount),
                intval($node->RelationshipsDestinationCount),
                intval($node->Rows),
                floatval($node->Size)
            );
        }
    }
}
