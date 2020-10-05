<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Tests\Request;

use Pzelant\ExpertSenderApi\Enum\HttpMethod;
use Pzelant\ExpertSenderApi\Enum\SubscribersGetRequest\DataOption;
use Pzelant\ExpertSenderApi\Request\SubscribersGetRequest;
use PHPUnit\Framework\Assert;

class SubscribersGetRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test
     */
    public function testValidUsage()
    {
        $request = new SubscribersGetRequest('email@email.ru', DataOption::SHORT());
        Assert::assertEquals('/v2/Api/Subscribers', $request->getUri());
        Assert::assertEquals(['email' => 'email@email.ru', 'option' => 'Short'], $request->getQueryParams());
        Assert::assertTrue($request->getMethod()->equals(HttpMethod::GET()));
        Assert::assertEquals('', $request->toXml());

        $requestLong = new SubscribersGetRequest('email@email.ru', DataOption::LONG());
        Assert::assertEquals(['email' => 'email@email.ru', 'option' => 'Long'], $requestLong->getQueryParams());

        $requestFull = new SubscribersGetRequest('email@email.ru', DataOption::FULL());
        Assert::assertEquals(['email' => 'email@email.ru', 'option' => 'Full'], $requestFull->getQueryParams());

        $requestEventsHistory = new SubscribersGetRequest('email@email.ru', DataOption::EVENTS_HISTORY());
        Assert::assertEquals(
            ['email' => 'email@email.ru', 'option' => 'EventsHistory'],
            $requestEventsHistory->getQueryParams()
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowExceptionIfEmailIsEmpty()
    {
        new SubscribersGetRequest('', DataOption::SHORT());
    }
}
