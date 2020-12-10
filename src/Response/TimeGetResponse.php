<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Response;

use Pzelant\ExpertSenderApi\Exception\ParseResponseException;
use Pzelant\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use Pzelant\ExpertSenderApi\SpecificXmlMethodResponse;

/**
 * Time of server response
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class TimeGetResponse extends SpecificXmlMethodResponse
{
    /**
     * Get server time
     *
     * @throws ParseResponseException If response is invalid, or Data content is not valid datetime string
     *
     * @return \DateTime Server time
     */
    public function getServerTime(): \DateTime
    {
        if (!$this->isOk()) {
            throw new TryToAccessDataFromErrorResponseException();
        }

        $dataAsString = strval($this->getSimpleXml()->xpath('/ApiResponse/Data')[0]);
        try {
            return new \DateTime($dataAsString);
        } catch (\Exception $e) {
            throw new ParseResponseException(
                sprintf('Cant\'t create DateTime object from string "%s"', $dataAsString),
                0,
                $e
            );
        }
    }
}
