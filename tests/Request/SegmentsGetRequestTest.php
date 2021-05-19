<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Tests\Request;

use Bridit\ExpertSenderApi\Enum\HttpMethod;
use Bridit\ExpertSenderApi\Request\SegmentsGetRequest;

/**
 * SegmentsGetRequestTest
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class SegmentsGetRequestTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test
     */
    public function testToXmlShouldReturnEmptyString()
    {
        $request = new SegmentsGetRequest();

        $this->assertSame('', $request->toXml());
    }

    /**
     * Test
     */
    public function testGetQueryParamsShouldReturnEmptyArray()
    {
        $request = new SegmentsGetRequest();

        $this->assertSame([], $request->getQueryParams());
    }

    /**
     * Test
     */
    public function testGetMethodShouldReturnGetHttpMethod()
    {
        $request = new SegmentsGetRequest();

        $this->assertTrue($request->getMethod()->equals(HttpMethod::GET()));
    }

    /**
     * Test
     */
    public function testGetUriShouldReturnProperUri()
    {
        $request = new SegmentsGetRequest();

        $this->assertSame('/v2/Api/Segments', $request->getUri());
    }
}
