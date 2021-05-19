<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Tests\Response;

use Bridit\ExpertSenderApi\Response;
use Bridit\ExpertSenderApi\Response\GetSegmentSizeGetResponse;
use PHPUnit\Framework\Assert;

/**
 * GetSegmentSizeGetResponseTest
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class GetSegmentSizeGetResponseTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test
     */
    public function testCommonUsage()
    {
        $xml = '<ApiResponse xmlns:xsd="http://www.w3.org/2001/XMLSchema" '
            . 'xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
           <Data>
              <Size>3384047</Size>
              <CountDate>2016-12-08T12:37:23.0784944Z</CountDate>
           </Data>
        </ApiResponse>';

        $response = new GetSegmentSizeGetResponse(
            new Response(
                new \GuzzleHttp\Psr7\Response(
                    200,
                    ['Content-Type' => 'text/xml', 'Content-Length' => strlen($xml)],
                    $xml
                )
            )
        );

        Assert::assertTrue($response->isOk());
        Assert::assertFalse($response->isEmpty());
        Assert::assertSame(3384047, $response->getSize());
        Assert::assertEquals('2016-12-08 12:37:23', $response->getCountDate()->format('Y-m-d H:i:s'));
    }

    /**
     * Test
     */
    public function testGetSizeThrowsExceptionIfResponseIsNotOk()
    {
      $this->expectException(\Bridit\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException::class);
      $xml = '<ApiResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"'
            . ' xmlns:xsd="http://www.w3.org/2001/XMLSchema">
                <ErrorMessage>
                    <Code>400</Code>
                    <Message>Error Message</Message>
                </ErrorMessage>
            </ApiResponse>';

        $response = new GetSegmentSizeGetResponse(
            new Response(
                new \GuzzleHttp\Psr7\Response(
                    400,
                    ['Content-Type' => 'text/xml', 'Content-Length' => strlen($xml)],
                    $xml
                )
            )
        );

        Assert::assertFalse($response->isOk());
        Assert::assertFalse($response->isEmpty());
        $response->getSize();
    }

    /**
     * Test
     */
    public function testGetCountDateThrowsExceptionIfResponseIsNotOk()
    {
      $this->expectException(\Bridit\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException::class);
      $xml = '<ApiResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"'
            . ' xmlns:xsd="http://www.w3.org/2001/XMLSchema">
                <ErrorMessage>
                    <Code>400</Code>
                    <Message>Error Message</Message>
                </ErrorMessage>
            </ApiResponse>';

        $response = new GetSegmentSizeGetResponse(
            new Response(
                new \GuzzleHttp\Psr7\Response(
                    400,
                    ['Content-Type' => 'text/xml', 'Content-Length' => strlen($xml)],
                    $xml
                )
            )
        );

        Assert::assertFalse($response->isOk());
        Assert::assertFalse($response->isEmpty());
        $response->getCountDate();
    }
}
