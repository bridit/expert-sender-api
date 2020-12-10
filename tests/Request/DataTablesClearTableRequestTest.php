<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Tests\Request;

use Pzelant\ExpertSenderApi\Enum\HttpMethod;
use Pzelant\ExpertSenderApi\Request\DataTablesClearTableRequest;
use PHPUnit\Framework\Assert;

/**
 * DataTablesClearTableRequestTest
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class DataTablesClearTableRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test
     */
    public function testCommonUsage()
    {
        $request = new DataTablesClearTableRequest('table-name');
        Assert::assertEquals([], $request->getQueryParams());
        Assert::assertEquals('/v2/Api/DataTablesClearTable', $request->getUri());
        Assert::assertTrue($request->getMethod()->equals(HttpMethod::POST()));
        Assert::assertEquals('<TableName>table-name</TableName>', $request->toXml());
    }
}
