<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Event;

use GuzzleHttp\Exception\RequestException;
use Symfony\Contracts\EventDispatcher\Event;
use Bridit\ExpertSenderApi\RequestInterface;

/**
 * Event on exception thrown while making request
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class RequestExceptionThrown extends Event
{
    /**
     * @var RequestInterface Request
     */
    private $request;

    /**
     * @var RequestException $exception
     */
    private $exception;

    /**
     * Constructor
     *
     * @param RequestInterface $apiRequest Api request
     * @param RequestException $exception Thrown exception
     */
    public function __construct(RequestInterface $apiRequest, RequestException $exception)
    {
        $this->request = $apiRequest;
        $this->exception = $exception;
    }

    /**
     * Get api request
     *
     * @return RequestInterface Api request
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    /**
     * Get thrown exception
     *
     * @return RequestException Thrown exception
     */
    public function getException(): RequestException
    {
        return $this->exception;
    }
}
