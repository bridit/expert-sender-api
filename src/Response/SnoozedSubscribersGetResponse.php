<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Response;

use Bridit\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use Bridit\ExpertSenderApi\Model\SnoozedSubscribersGetResponse\SnoozedSubscriber;
use Bridit\ExpertSenderApi\SpecificXmlMethodResponse;

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
