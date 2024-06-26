<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Tests\Request;

use Bridit\ExpertSenderApi\Enum\HttpMethod;
use Bridit\ExpertSenderApi\Enum\RemovedSubscribersGetRequest\Option;
use Bridit\ExpertSenderApi\Enum\RemovedSubscribersGetRequest\RemoveType;
use Bridit\ExpertSenderApi\Request\RemovedSubscriberGetRequest;
use PHPUnit\Framework\Assert;

/**
 * RemovedSubscriberGetRequestTest
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class RemovedSubscriberGetRequestTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test
     */
    public function testQueryParams()
    {
        $request = new RemovedSubscriberGetRequest(
            [1, 2, 3],
            [RemoveType::API(), RemoveType::COMPLAINT()],
            new \DateTime('2017-10-01'),
            new \DateTime('2017-10-30'),
            Option::CUSTOMS()
        );

        Assert::assertEquals(
            [
                'listIds' => '1,2,3',
                'removeTypes' => 'Api,Complaint',
                'startDate' => '2017-10-01',
                'endDate' => '2017-10-30',
                'option' => 'Customs',
            ],
            $request->getQueryParams()
        );
        Assert::assertTrue($request->getMethod()->equals(HttpMethod::GET()));
        Assert::assertEquals('/v2/Api/RemovedSubscribers', $request->getUri());
        Assert::assertEmpty($request->toXml());
    }
}
