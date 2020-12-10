<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Tests\Request;

use Pzelant\ExpertSenderApi\Enum\HttpMethod;
use Pzelant\ExpertSenderApi\Request\GetSegmentSizeGetRequest;
use PHPUnit\Framework\Assert;

/**
 * GetSegmentSizeGetRequestTest
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class GetSegmentSizeGetRequestTest extends \PHPUnit_Framework_TestCase
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
