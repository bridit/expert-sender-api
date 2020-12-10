<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Response;

use Pzelant\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use Pzelant\ExpertSenderApi\Model\SnoozedSubscribersGetResponse\SnoozedSubscriber;
use Pzelant\ExpertSenderApi\SpecificXmlMethodResponse;

/**
 * Response of get snoozed subscribers request
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class SnoozedSubscribersGetResponse extends SpecificXmlMethodResponse
{
    /**
     * Get snoozed subscribers
     *
     * @return SnoozedSubscriber[]|iterable Snoozed subscribers
     */
    public function getSnoozedSubscribers(): iterable
    {
        if (!$this->isOk()) {
            throw TryToAccessDataFromErrorResponseException::createFromResponse($this);
        }

        $nodes = $this->getSimpleXml()->xpath('/ApiResponse/Data/SnoozedSubscribers/SnoozedSubscriber');
        foreach ($nodes as $node) {
            yield new SnoozedSubscriber(
                strval($node->Email),
                intval($node->ListId),
                new \DateTime(strval($node->SnoozedUntil))
            );
        }
    }
}
