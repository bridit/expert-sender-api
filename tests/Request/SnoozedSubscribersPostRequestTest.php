<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Tests\Request;

use Bridit\ExpertSenderApi\Enum\HttpMethod;
use Bridit\ExpertSenderApi\Request\SnoozedSubscribersPostRequest;

/**
 * SnoozedSubscribersPostRequestTest
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class SnoozedSubscribersPostRequestTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test
     */
    public function testCreateWithId()
    {
        $id = 567;
        $snoozedWeeks = 23;
        $listId = 27;
        $request = SnoozedSubscribersPostRequest::createWithId($id, $snoozedWeeks, $listId);

        $this->assertSame([], $request->getQueryParams());
        $this->assertSame('/v2/Api/SnoozedSubscribers', $request->getUri());
        $this->assertSame('<Id>567</Id><ListId>27</ListId><SnoozeWeeks>23</SnoozeWeeks>', $request->toXml());
        $this->assertTrue($request->getMethod()->equals(HttpMethod::POST()));
    }

    /**
     * Test
     */
    public function testCreateWithEmail()
    {
        $email = 'test@test.ru';
        $snoozedWeeks = 23;
        $listId = 27;
        $request = SnoozedSubscribersPostRequest::createWithEmail($email, $snoozedWeeks, $listId);

        $this->assertSame([], $request->getQueryParams());
        $this->assertSame('/v2/Api/SnoozedSubscribers', $request->getUri());
        $this->assertSame('<Email>test@test.ru</Email><ListId>27</ListId><SnoozeWeeks>23</SnoozeWeeks>', $request->toXml());
        $this->assertTrue($request->getMethod()->equals(HttpMethod::POST()));
    }

    /**
     * Test
     */
    public function testXmlShouldNotContainListIdIfItValusIsNull()
    {
        $request = SnoozedSubscribersPostRequest::createWithId(567, 23);

        $this->assertSame('<Id>567</Id><SnoozeWeeks>23</SnoozeWeeks>', $request->toXml());
    }

    /**
     * Test
     */
    public function testConstructorShouldThrowExceptionIfSnoozeWeeksLessThanOne()
    {
      $this->expectException(\InvalidArgumentException::class);
      $this->expectExceptionMessage("Expected a value greater than or equal to 1. Got: 0");
      SnoozedSubscribersPostRequest::createWithId(567, 0);
    }

    /**
     * Test
     */
    public function testConstructorShouldThrowExceptionIfSnoozeWeeksGreaterThan26()
    {
      $this->expectException(\InvalidArgumentException::class);
      $this->expectExceptionMessage("Expected a value less than or equal to 26. Got: 27");
      SnoozedSubscribersPostRequest::createWithId(567, 27);
    }
}
