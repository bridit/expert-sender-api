<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Tests\Request;

use Bridit\ExpertSenderApi\Enum\DataTablesGetDataPostRequest\Direction;
use Bridit\ExpertSenderApi\Enum\DataTablesGetDataPostRequest\Operator;
use Bridit\ExpertSenderApi\Enum\HttpMethod;
use Bridit\ExpertSenderApi\Model\DataTablesGetDataPostRequest\OrderByRule;
use Bridit\ExpertSenderApi\Model\WhereCondition;
use Bridit\ExpertSenderApi\Request\DataTablesGetDataPostRequest;
use PHPUnit\Framework\Assert;

class DataTablesGetDataPostRequestTest extends \PHPUnit\Framework\TestCase
{
    public function testCommonUsage()
    {
        $request = new DataTablesGetDataPostRequest(
            'table-name',
            ['Column1', 'Column2'],
            [
                new WhereCondition('Column1', Operator::EQUAL(), 12),
                new WhereCondition('Column2', Operator::GREATER(), 12.53),
                new WhereCondition('Column3', Operator::LOWER(), -0.56),
                new WhereCondition('Column5', Operator::LIKE(), 'string'),
            ],
            [
                new OrderByRule('Column1', Direction::DESCENDING()),
                new OrderByRule('Columne2', Direction::ASCENDING()),
            ],
            25
        );

        $xml = '<TableName>table-name</TableName><Columns><Column>Column1</Column><Column>Column2</Column>'
            . '</Columns><WhereConditions><Where><ColumnName>Column1</ColumnName><Operator>Equals</Operator>'
            . '<Value>12</Value></Where><Where><ColumnName>Column2</ColumnName><Operator>Greater</Operator>'
            . '<Value>12.53</Value></Where><Where><ColumnName>Column3</ColumnName><Operator>Lower</Operator>'
            . '<Value>-0.56</Value></Where><Where><ColumnName>Column5</ColumnName><Operator>Like</Operator>'
            . '<Value>string</Value></Where></WhereConditions><OrderByColumns><OrderBy>'
            . '<ColumnName>Column1</ColumnName><Direction>Descending</Direction></OrderBy><OrderBy>'
            . '<ColumnName>Columne2</ColumnName><Direction>Ascending</Direction></OrderBy></OrderByColumns>'
            . '<Limit>25</Limit>';
        Assert::assertEquals($xml, $request->toXml());
        Assert::assertEquals([], $request->getQueryParams());
        Assert::assertTrue($request->getMethod()->equals(HttpMethod::POST()));
        Assert::assertEquals('/v2/Api/DataTablesGetData', $request->getUri());
    }
}
