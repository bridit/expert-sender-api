<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Tests\Request;

use Bridit\ExpertSenderApi\Enum\HttpMethod;
use Bridit\ExpertSenderApi\Request\TimeGetRequest;
use PHPUnit\Framework\Assert;

class TimeGetRequestTest extends \PHPUnit\Framework\TestCase
{
    public function testValidUsage()
    {
        $request = new TimeGetRequest();
        Assert::assertEquals([], $request->getQueryParams());
        Assert::assertTrue($request->getMethod()->equals(HttpMethod::GET()));
        Assert::assertEquals('/v2/Api/Time', $request->getUri());
        Assert::assertEquals('', $request->toXml());
    }
}
