<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Tests\Request;

use Pzelant\ExpertSenderApi\Enum\DataTablesGetDataPostRequest\Operator;
use Pzelant\ExpertSenderApi\Enum\HttpMethod;
use Pzelant\ExpertSenderApi\Model\WhereCondition;
use Pzelant\ExpertSenderApi\Request\DataTablesGetDataCountRequest;
use PHPUnit\Framework\Assert;

/**
 * DataTablesGetDataCountRequestTest
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class DataTablesGetDataCountRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test
     */
    public function testCommonUsage()
    {
        $request = new DataTablesGetDataCountRequest(
            'table-name',
            [
                new WhereCondition('Column1', Operator::EQUAL(), 12),
                new WhereCondition('Column2', Operator::GREATER(), 12.53),
                new WhereCondition('Column3', Operator::LOWER(), -0.56),
                new WhereCondition('Column5', Operator::LIKE(), 'string'),
            ]
        );

        Assert::assertEquals([], $request->getQueryParams());
        Assert::assertTrue($request->getMethod()->equals(HttpMethod::POST()));
        Assert::assertEquals('/v2/Api/DataTablesGetDataCount', $request->getUri());
        Assert::assertEquals(
            '<TableName>table-name</TableName><WhereConditions><Where><ColumnName>Column1</ColumnName>'
            . '<Operator>Equals</Operator><Value>12</Value></Where><Where><ColumnName>Column2</ColumnName>'
            . '<Operator>Greater</Operator><Value>12.53</Value></Where><Where><ColumnName>Column3</ColumnName>'
            . '<Operator>Lower</Operator><Value>-0.56</Value></Where><Where><ColumnName>Column5</ColumnName>'
            . '<Operator>Like</Operator><Value>string</Value></Where></WhereConditions>',
            $request->toXml()
        );
    }
}
