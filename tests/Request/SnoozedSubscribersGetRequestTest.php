<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Tests\Request;

use Pzelant\ExpertSenderApi\Enum\HttpMethod;
use Pzelant\ExpertSenderApi\Request\SnoozedSubscribersGetRequest;
use PHPUnit\Framework\Assert;

/**
 * SnoozedSubscribersGetRequestTest
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class SnoozedSubscribersGetRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test
     */
    public function testCommonUsage()
    {
        $request = new SnoozedSubscribersGetRequest(
            [1, 2, 3, 4],
            new \DateTime('2017-01-01'),
            new \DateTime('2017-02-02')
        );

        Assert::assertEquals('', $request->toXml());
        Assert::assertEquals(
            [
                'listIds' => '1,2,3,4',
                'startDate' => '2017-01-01',
                'endDate' => '2017-02-02',
            ],
            $request->getQueryParams()
        );
        Assert::assertEquals('/v2/Api/SnoozedSubscribers', $request->getUri());
        Assert::assertTrue($request->getMethod()->equals(HttpMethod::GET()));
    }
}
