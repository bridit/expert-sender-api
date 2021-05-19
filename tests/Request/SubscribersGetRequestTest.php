<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Tests\Request;

use Bridit\ExpertSenderApi\Enum\HttpMethod;
use Bridit\ExpertSenderApi\Enum\SubscribersGetRequest\DataOption;
use Bridit\ExpertSenderApi\Request\SubscribersGetRequest;
use PHPUnit\Framework\Assert;

class SubscribersGetRequestTest extends \PHPUnit\Framework\TestCase
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

  public function testThrowExceptionIfEmailIsEmpty()
    {
      $this->expectException(\InvalidArgumentException::class);
      new SubscribersGetRequest('', DataOption::SHORT());
    }
}
