<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Exception;

use Pzelant\ExpertSenderApi\ResponseInterface;

/**
 * Exception of get data on not success response
 *
 * @author Nikita Sapogov <sapogov.n@Pzelant.ru>
 */
class TryToAccessDataFromErrorResponseException extends ExpertSenderApiException
{
    /**
     * Constructor
     *
     * @param ResponseInterface $response ExpertSender API's Response
     *
     * @return static Exception of get data on not success response
     */
    public static function createFromResponse(ResponseInterface $response)
    {
        return new static(
            sprintf(
                'Trying to get data from not successful response. Response content: '
                . '[%s], HTTP status code: %d',
                $response->getContent(),
                $response->getHttpStatusCode()
            )
        );
    }
}
