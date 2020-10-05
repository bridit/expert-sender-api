<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Resource;

use Pzelant\ExpertSenderApi\AbstractResource;
use Pzelant\ExpertSenderApi\Model\Column;
use Pzelant\ExpertSenderApi\Model\DataTablesAddMultipleRowsPostRequest\Row;
use Pzelant\ExpertSenderApi\Model\DataTablesDeleteRowsPostRequest\Filter;
use Pzelant\ExpertSenderApi\Model\DataTablesGetDataPostRequest\OrderByRule;
use Pzelant\ExpertSenderApi\Model\WhereCondition;
use Pzelant\ExpertSenderApi\Request\DataTablesAddMultipleRowsPostRequest;
use Pzelant\ExpertSenderApi\Request\DataTablesClearTableRequest;
use Pzelant\ExpertSenderApi\Request\DataTablesDeleteRowPostRequest;
use Pzelant\ExpertSenderApi\Request\DataTablesDeleteRowsPostRequest;
use Pzelant\ExpertSenderApi\Request\DataTablesGetDataCountRequest;
use Pzelant\ExpertSenderApi\Request\DataTablesGetDataPostRequest;
use Pzelant\ExpertSenderApi\Request\DataTablesGetTablesRequest;
use Pzelant\ExpertSenderApi\Request\DataTablesUpdateRowPostRequest;
use Pzelant\ExpertSenderApi\Response\CountResponse;
use Pzelant\ExpertSenderApi\Response\DataTablesGetTablesDetailsResponse;
use Pzelant\ExpertSenderApi\Response\DataTablesGetTablesSummaryResponse;
use Pzelant\ExpertSenderApi\ResponseInterface;
use Pzelant\ExpertSenderApi\SpecificCsvMethodResponse;

/**
 * Data tables resource
 *
 * @author Nikita Sapogov <sapogov.n@Pzelant.ru>
 */
class DataTablesResource extends AbstractResource
{
    /**
     * Add rows to table
     *
     * @param string $tableName Table name
     * @param Row[]|iterable $rows Rows
     *
     * @return ResponseInterface Response
     */
    public function addRows(string $tableName, iterable $rows): ResponseInterface
    {
        return $this->requestSender->send(new DataTablesAddMultipleRowsPostRequest($tableName, $rows));
    }

    /**
     * Get table rows
     *
     * @param string $tableName Table name
     * @param string[] $columnNames Column names
     * @param WhereCondition[] $whereConditions Where conditions
     * @param OrderByRule[] $orderByRules Order by rules
     * @param int $limit Limit
     *
     * @return SpecificCsvMethodResponse Response
     */
    public function getRows(
        string $tableName,
        array $columnNames = [],
        array $whereConditions = [],
        array $orderByRules = [],
        $limit = null
    ): SpecificCsvMethodResponse {
        return new SpecificCsvMethodResponse(
            $this->requestSender->send(
                new DataTablesGetDataPostRequest($tableName, $columnNames, $whereConditions, $orderByRules, $limit)
            )
        );
    }

    /**
     * Update rows
     *
     * @param string $tableName Table name
     * @param Column[] $primaryKeyColumns Primary key columns. Collection of Column elements. Contains unique
     *      identifier (PK, primary key) of the row that is supposed to be updated. This is an equivalent of
     *      SQL "WHERE" directive
     * @param Column[] $columns Columns. Collection of Column elements. Contains information about columns that are
     *      supposed to be updated and their new values. This is an equivalent of SQL "SET" directive
     *
     * @return ResponseInterface Response
     */
    public function updateRow(string $tableName, array $primaryKeyColumns, array $columns): ResponseInterface
    {
        return $this->requestSender->send(new DataTablesUpdateRowPostRequest($tableName, $primaryKeyColumns, $columns));
    }

    /**
     * Delete one row
     *
     * @param string $tableName Table name
     * @param Column[] $primaryKeyColumns Primary key columns. Collection of Column elements. Contains unique
     *      identifier (PK, primary key) of the row that is supposed to be deleted. This is an equivalent of SQL
     *      "WHERE" directive
     *
     * @return ResponseInterface Response
     */
    public function deleteOneRow(string $tableName, array $primaryKeyColumns): ResponseInterface
    {
        return $this->requestSender->send(new DataTablesDeleteRowPostRequest($tableName, $primaryKeyColumns));
    }

    /**
     * Delete rows
     *
     * @param string $tableName Table name
     * @param Filter[] $filters Filters. This is an equivalent of SQL "WHERE" directive
     *
     * @return CountResponse Response
     */
    public function deleteRows(string $tableName, array $filters): CountResponse
    {
        return new CountResponse(
            $this->requestSender->send(new DataTablesDeleteRowsPostRequest($tableName, $filters))
        );
    }

    /**
     * Clear table
     *
     * @param string $tableName Table name
     *
     * @return ResponseInterface Response
     */
    public function clearTable(string $tableName): ResponseInterface
    {
        return $this->requestSender->send(new DataTablesClearTableRequest($tableName));
    }

    /**
     * Get count of rows in table
     *
     * @param string $tableName Table name
     * @param array $whereConditions Where conditions
     *
     * @return CountResponse Response
     */
    public function getRowsCount(string $tableName, array $whereConditions): CountResponse
    {
        return new CountResponse(
            $this->requestSender->send(new DataTablesGetDataCountRequest($tableName, $whereConditions))
        );
    }

    /**
     * Get list of tables
     *
     * @return DataTablesGetTablesSummaryResponse Response with tables summary
     */
    public function getTablesList(): DataTablesGetTablesSummaryResponse
    {
        return new DataTablesGetTablesSummaryResponse(
            $this->requestSender->send(new DataTablesGetTablesRequest(null))
        );
    }

    /**
     * Get details of table
     *
     * @param string $tableName Table name
     *
     * @return DataTablesGetTablesDetailsResponse Response with details of table
     */
    public function getTableDetails($tableName): DataTablesGetTablesDetailsResponse
    {
        return new DataTablesGetTablesDetailsResponse(
            $this->requestSender->send(new DataTablesGetTablesRequest($tableName))
        );
    }
}
