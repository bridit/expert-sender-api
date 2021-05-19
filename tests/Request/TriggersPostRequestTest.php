<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Tests\Request;

use Bridit\ExpertSenderApi\Enum\HttpMethod;
use Bridit\ExpertSenderApi\Model\TriggersPostRequest\Receiver;
use Bridit\ExpertSenderApi\Request\TriggersPostRequest;
use PHPUnit\Framework\Assert;

/**
 * TriggersPostRequestTest
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class TriggersPostRequestTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test
     */
    public function testCommonUsage()
    {
        $request = new TriggersPostRequest(
            24,
            [
                Receiver::createFromEmail('mail@mail.com'),
                Receiver::createFromId(23),
            ]
        );

        $xml = '<Data xsi:type="TriggerReceivers"><Receivers><Receiver><Email>mail@mail.com</Email></Receiver>'
            . '<Receiver><Id>23</Id></Receiver></Receivers></Data>';
        Assert::assertEquals($xml, $request->toXml());
        Assert::assertEquals([], $request->getQueryParams());
        Assert::assertTrue($request->getMethod()->equals(HttpMethod::POST()));
        Assert::assertEquals('/v2/Api/Triggers/24', $request->getUri());
    }
}
