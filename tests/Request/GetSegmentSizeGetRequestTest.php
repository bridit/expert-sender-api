<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Tests\Request;

use Bridit\ExpertSenderApi\Enum\HttpMethod;
use Bridit\ExpertSenderApi\Request\GetSegmentSizeGetRequest;
use PHPUnit\Framework\Assert;

/**
 * GetSegmentSizeGetRequestTest
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class GetSegmentSizeGetRequestTest extends \PHPUnit\Framework\TestCase
{
    public function testCommonUsage()
    {
        $request = new GetSegmentSizeGetRequest(25);
        Assert::assertEquals(['id' => 25], $request->getQueryParams());
        Assert::assertTrue($request->getMethod()->equals(HttpMethod::GET()));
        Assert::assertEquals('', $request->toXml());
        Assert::assertEquals('/v2/Api/GetSegmentSize', $request->getUri());
    }
}
