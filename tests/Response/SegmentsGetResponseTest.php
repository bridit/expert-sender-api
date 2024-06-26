<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Tests\Response;

use Bridit\ExpertSenderApi\Model\SegmentsGetResponse\Segment;
use Bridit\ExpertSenderApi\Response;
use Bridit\ExpertSenderApi\Response\SegmentsGetResponse;
use function iter\toArray;

/**
 * SegmentsGetResponseTest
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class SegmentsGetResponseTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test
     */
    public function testGetSegments()
    {
        $xml = '<ApiResponse xmlns:xsd="http://www.w3.org/2001/XMLSchema" '
            . 'xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
          <Data>
            <Segments>
              <Segment>
                <Id>1</Id>
                <Name>Clickers segment</Name>
              </Segment>
              <Segment>
                <Id>3</Id>
                <Name>New subscribers</Name>
              </Segment>
              <Segment>
                <Id>4</Id>
                <Name>Car owners</Name>
              </Segment>
            </Segments>
          </Data>
        </ApiResponse>';
        $response = new SegmentsGetResponse(
            new Response(
                new \GuzzleHttp\Psr7\Response(
                    200,
                    ['Content-Length' => strlen($xml), 'Content-Type' => 'text/xml'],
                    $xml
                )
            )
        );

        $this->assertTrue($response->isOk());
        $this->assertFalse($response->isEmpty());
        /** @var Segment[] $segments */
        $segments = toArray($response->getSegments());

        $this->assertCount(3, $segments);

        $this->assertEquals(1, $segments[0]->getId());
        $this->assertEquals('Clickers segment', $segments[0]->getName());

        $this->assertEquals(3, $segments[1]->getId());
        $this->assertEquals('New subscribers', $segments[1]->getName());

        $this->assertEquals(4, $segments[2]->getId());
        $this->assertEquals('Car owners', $segments[2]->getName());
    }
}
