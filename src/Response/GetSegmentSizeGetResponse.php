<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Response;

use Pzelant\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use Pzelant\ExpertSenderApi\SpecificXmlMethodResponse;

/**
 * Response with information of Segment
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class GetSegmentSizeGetResponse extends SpecificXmlMethodResponse
{
    /**
     * Get size of segment
     *
     * @return int Size of segment
     */
    public function getSize(): int
    {
        if (!$this->isOk()) {
            throw TryToAccessDataFromErrorResponseException::createFromResponse($this);
        }

        return intval($this->getSimpleXml()->xpath('/ApiResponse/Data/Size')[0]);
    }

    /**
     * Get date of last segment size recalculation
     *
     * @return \DateTime Date of last segment size recalculation
     */
    public function getCountDate(): \DateTime
    {
        if (!$this->isOk()) {
            throw TryToAccessDataFromErrorResponseException::createFromResponse($this);
        }

        return new \DateTime(strval($this->getSimpleXml()->xpath('/ApiResponse/Data/CountDate')[0]));
    }
}
