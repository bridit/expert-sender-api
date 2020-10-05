<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Response;

use Pzelant\ExpertSenderApi\Model\SubscribersPostResponse\SubscriberData;
use Pzelant\ExpertSenderApi\SpecificXmlMethodResponse;
use Pzelant\ExpertSenderApi\Utils;

/**
 * Response of add/edit subscriber request
 *
 * @author Nikita Sapogov <sapogov.n@Pzelant.ru>
 */
class SubscribersPostResponse extends SpecificXmlMethodResponse
{
    /**
     * Get subscribers info after add/edit
     *
     * @return SubscriberData[] Subscribers info after add/edit
     */
    public function getChangedSubscribersData(): array
    {
        $nodes = $this->getSimpleXml()->xpath('/ApiResponse/Data/SubscriberData');
        $subscriberDataList = [];
        foreach ($nodes as $node) {
            $subscriberDataList[] = new SubscriberData(
                strval($node->Email),
                intval($node->Id),
                Utils::convertStringBooleanEquivalentToBool(strval($node->WasAdded)),
                Utils::convertStringBooleanEquivalentToBool(strval($node->WasIgnored))
            );
        }

        return $subscriberDataList;
    }
}
