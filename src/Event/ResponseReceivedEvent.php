<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Event;

use Pzelant\ExpertSenderApi\ResponseInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Event after response received
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class ResponseReceivedEvent extends Event
{
    /**
     * @var ResponseInterface Response
     */
    private $response;

    /**
     * Constructor.
     *
     * @param ResponseInterface $response Response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * Get response
     *
     * @return ResponseInterface Response
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
