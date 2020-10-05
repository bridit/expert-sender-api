<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Exception;

use Pzelant\ExpertSenderApi\ResponseInterface;

/**
 * Exception while parse ExpertSender API's response
 *
 * @author Nikita Sapogov <sapogov.n@Pzelant.ru>
 */
class ParseResponseException extends ExpertSenderApiException
{
    /**
     * Constructor
     *
     * @param string $message Message
     * @param ResponseInterface $response Response
     *
     * @return static Exception while parse ExpertSender API's response
     */
    public static function createFromResponse(string $message, ResponseInterface $response)
    {
        return new static(
            sprintf(
                '%s. Content: [%s...]',
                $message,
                substr($response->getContent(), 0, 100)
            )
        );
    }
}
