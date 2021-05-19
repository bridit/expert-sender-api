<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Tests\Request;

use Bridit\ExpertSenderApi\Enum\HttpMethod;
use Bridit\ExpertSenderApi\Request\DataTablesGetTablesRequest;
use PHPUnit\Framework\Assert;

/**
 * DataTablesGetTablesRequestTest
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class DataTablesGetTablesRequestTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test
     */
    public function testCreateWithTableName()
    {
        $request = new DataTablesGetTablesRequest('table-name');
        Assert::assertEquals(['name' => 'table-name'], $request->getQueryParams());
        Assert::assertEquals('/v2/Api/DataTablesGetTables', $request->getUri());
        Assert::assertTrue($request->getMethod()->equals(HttpMethod::GET()));
        Assert::assertEquals('', $request->toXml());
    }

    /**
     * Test
     */
    public function testCreateWithoutTableName()
    {
        $request = new DataTablesGetTablesRequest(null);
        Assert::assertEquals([], $request->getQueryParams());
        Assert::assertEquals('/v2/Api/DataTablesGetTables', $request->getUri());
        Assert::assertTrue($request->getMethod()->equals(HttpMethod::GET()));
        Assert::assertEquals('', $request->toXml());
    }
}
