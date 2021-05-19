<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Response;

use Bridit\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use Bridit\ExpertSenderApi\SpecificXmlMethodResponse;

/**
 * Response with count info
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class CountResponse extends SpecificXmlMethodResponse
{
    /**
     * Get count
     *
     * @return int Count
     */
    public function getCount(): int
    {
        if (!$this->isOk()) {
            throw TryToAccessDataFromErrorResponseException::createFromResponse($this);
        }

        return intval($this->getSimpleXml()->xpath('/ApiResponse/Count')[0]);
    }
}
