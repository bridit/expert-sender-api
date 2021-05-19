<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Tests\Response;

use Bridit\ExpertSenderApi\Response;
use Bridit\ExpertSenderApi\Response\TimeGetResponse;
use PHPUnit\Framework\Assert;

class TimeGetResponseTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test
     */
    public function testNormalDateShouldWorkFine()
    {
        $body = '<ApiResponse xmlns:xsd="http://www.w3.org/2001/XMLSchema" '
            . 'xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
            <Data>2013-04-24T10:33:09.4338472Z</Data>
            </ApiResponse>';

        $response = new TimeGetResponse(new Response(new \GuzzleHttp\Psr7\Response(200, [], $body)));
        Assert::assertTrue($response->isOk());
        Assert::assertEquals('2013-04-24T10:33:09', $response->getServerTime()->format('Y-m-d\TH:i:s'));
        Assert::assertEquals(200, $response->getHttpStatusCode());
        Assert::assertCount(0, $response->getErrorMessages());
        Assert::assertNull($response->getErrorCode());
    }

    /**
     * Test
     *
     *
     */
    public function testThrowExceptionIfDateStringIsWrong()
    {
      $this->expectException(\Bridit\ExpertSenderApi\Exception\ParseResponseException::class);
      $body = '<ApiResponse xmlns:xsd="http://www.w3.org/2001/XMLSchema" '
            . 'xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
            <Data>WRONG_DATA</Data>
            </ApiResponse>';

        $response = new TimeGetResponse(
            new Response(
                new \GuzzleHttp\Psr7\Response(
                    200,
                    ['Content-Type' => 'text/xml', 'Content-Length' => strlen($body)],
                    $body
                )
            )
        );
        Assert::assertTrue($response->isOk());
        Assert::assertEquals('2013-04-24T10:33:09', $response->getServerTime()->format('Y-m-d\TH:i:s'));
        Assert::assertEquals(200, $response->getHttpStatusCode());
    }

    /**
     * Test
     *
     *
     */
    public function testThrowExceptionIfTryingGetServerTimeOnNotOkResponse()
    {
      $this->expectException(\Bridit\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException::class);
      $response = new TimeGetResponse(new Response(new \GuzzleHttp\Psr7\Response(500, [], '')));
        $response->getServerTime();
    }
}
