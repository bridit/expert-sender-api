<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Response;

use Pzelant\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use Pzelant\ExpertSenderApi\Model\SubscribersGetResponse\Event;
use Pzelant\ExpertSenderApi\SpecificXmlMethodResponse;

/**
 * Subscriber's history of events
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class SubscribersGetEventsHistoryResponse extends SpecificXmlMethodResponse
{
    /**
     * Get events
     *
     * @throws TryToAccessDataFromErrorResponseException If response has errors
     *
     * @return Event[]|\Generator Events
     */
    public function getEvents(): \Generator
    {
        if (!$this->isOk()) {
            throw TryToAccessDataFromErrorResponseException::createFromResponse($this);
        }

        $nodes = $this->getSimpleXml()->xpath('/ApiResponse/Data/Events/Event');
        foreach ($nodes as $node) {
            $event = new Event(
                new \DateTime(strval($node->StartDate)),
                new \DateTime(strval($node->EndDate)),
                strval($node->MessageType),
                strval($node->EventType),
                intval($node->EventCount),
                intval($node->MessageId),
                strval($node->MessageSubject)
            );

            yield $event;
        }
    }
}
