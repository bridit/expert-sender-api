<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Response;

use Bridit\ExpertSenderApi\Enum\SubscribersResponse\StateOnListStatus;
use Bridit\ExpertSenderApi\Exception\ParseResponseException;
use Bridit\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use Bridit\ExpertSenderApi\Model\SubscribersGetResponse\StateOnList;
use Bridit\ExpertSenderApi\SpecificXmlMethodResponse;

/**
 * Short information about subscriber
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class SubscribersGetShortResponse extends SpecificXmlMethodResponse
{
    /**
     * Is subscriber in black list (local or global)
     *
     * @return bool Is subscriber in black list (local or global)
     */
    public function isInBlackList()
    {
        if (!$this->isOk()) {
            throw TryToAccessDataFromErrorResponseException::createFromResponse($this);
        }

        $xml = $this->getSimpleXml();
        $nodes = $xml->xpath('/ApiResponse/Data/BlackList');
        if (count($nodes) === 0) {
            throw ParseResponseException::createFromResponse('Can\'t fine BlackList element' , $this);
        }

        return strval(reset($nodes)) === 'true';
    }

    /**
     * Get all state on list
     *
     * @return StateOnList[] States on list
     * @throws \Exception
     */
    public function getStateOnLists(): array
    {
        if (!$this->isOk()) {
            throw TryToAccessDataFromErrorResponseException::createFromResponse($this);
        }

        $xml = $this->getSimpleXml();
        $nodes = $xml->xpath('/ApiResponse/Data/StateOnLists/StateOnList');

        $array = [];
        foreach ($nodes as $node) {
            $array[] = new StateOnList(
                intval($node->ListId),
                strval($node->Name),
                new StateOnListStatus(strval($node->Status)),
                new \DateTime(strval($node->SubscriptionDate))
            );
        }

        return $array;
    }
}
