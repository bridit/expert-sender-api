<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Tests\Request;

use Bridit\ExpertSenderApi\Enum\HttpMethod;
use Bridit\ExpertSenderApi\Request\SubscribersDeleteRequest;
use PHPUnit\Framework\Assert;

class SubscribersDeleteRequestTest extends \PHPUnit\Framework\TestCase
{
    public function testCreateWithId()
    {
        $request = SubscribersDeleteRequest::createFromId(12, 25);
        Assert::assertEquals('', $request->toXml());
        Assert::assertEquals('/v2/Api/Subscribers', $request->getUri());
        Assert::assertTrue($request->getMethod()->equals(HttpMethod::DELETE()));
        Assert::assertEquals(['id' => 12, 'listId' => 25], $request->getQueryParams());
    }

    public function testCreateWithEmail()
    {
        $request = SubscribersDeleteRequest::createFromEmail('mail@mail.com');
        Assert::assertEquals(['email' => 'mail@mail.com'], $request->getQueryParams());
    }
}
