<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Tests\Request;

use Pzelant\ExpertSenderApi\Enum\ActivitiesGetRequest\ActivityType;
use Pzelant\ExpertSenderApi\Enum\ActivitiesGetRequest\ReturnColumnsSet;
use Pzelant\ExpertSenderApi\Enum\HttpMethod;
use Pzelant\ExpertSenderApi\Request\ActivitiesGetRequest;
use PHPUnit\Framework\Assert;

/**
 * ActivitiesGetRequestTest
 *
 * @author Nikita Sapogov <sapogov.n@Pzelant.ru>
 */
class ActivitiesGetRequestTest extends \PHPUnit_Framework_TestCase
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
