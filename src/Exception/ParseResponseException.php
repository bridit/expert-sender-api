<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Exception;

use Bridit\ExpertSenderApi\ResponseInterface;

/**
 * Exception while parse ExpertSender API's response
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
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
    public static function createFromResponse(string $message, ResponseInterface $response): static
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
