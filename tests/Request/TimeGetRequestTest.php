<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Tests\Request;

use Pzelant\ExpertSenderApi\Enum\HttpMethod;
use Pzelant\ExpertSenderApi\Request\TimeGetRequest;
use PHPUnit\Framework\Assert;

class TimeGetRequestTest extends \PHPUnit_Framework_TestCase
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
