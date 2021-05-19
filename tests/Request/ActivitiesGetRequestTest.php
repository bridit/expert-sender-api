<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Tests\Request;

use Bridit\ExpertSenderApi\Enum\ActivitiesGetRequest\ActivityType;
use Bridit\ExpertSenderApi\Enum\ActivitiesGetRequest\ReturnColumnsSet;
use Bridit\ExpertSenderApi\Enum\HttpMethod;
use Bridit\ExpertSenderApi\Request\ActivitiesGetRequest;
use PHPUnit\Framework\Assert;

/**
 * ActivitiesGetRequestTest
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class ActivitiesGetRequestTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test
     */
    public function testCommonUsage()
    {
        $request = new ActivitiesGetRequest(
            new \DateTime('2017-05-27'),
            ActivityType::COMPLAINTS(),
            ReturnColumnsSet::EXTENDED(),
            true,
            true
        );

        Assert::assertEquals('/v2/Api/Activities', $request->getUri());
        Assert::assertEquals(
            [
                'date' => '2017-05-27',
                'type' => 'Complaints',
                'columns' => 'Extended',
                'returnTitle' => 'true',
                'returnGuid' => 'true',
            ],
            $request->getQueryParams()
        );
        Assert::assertEquals('', $request->toXml());
        Assert::assertTrue($request->getMethod()->equals(HttpMethod::GET()));
    }
}
