<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Response;

use Bridit\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;

/**
 * Long information of subscriber
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class SubscribersGetLongResponse extends SubscribersGetShortResponse
{
    /**
     * Get stop-lists which contains subscriber
     *
     * @return array Stop-lists which contains subscriber [<suppresion-list-id> => '<suppresion-list-name>']
     */
    public function getSuppressionStopLists(): array
    {
        if (!$this->isOk()) {
            throw TryToAccessDataFromErrorResponseException::createFromResponse($this);
        }

        $xml = $this->getSimpleXml();
        $nodes = $xml->xpath('/ApiResponse/Data/EmailInSuppressionLists/SuppressionList');
        $suppressionLists = [];
        foreach ($nodes as $node) {
            $suppressionLists[intval($node->Id)] = strval($node->Name);
        }

        return $suppressionLists;
    }
}
