<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi;

/**
 * Abstract resource
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class AbstractResource
{
    /**
     * @var RequestSenderInterface Request sender
     */
    protected $requestSender;

    /**
     * Constructor.
     *
     * @param RequestSenderInterface $requestSender Request sender
     */
    public function __construct(RequestSenderInterface $requestSender)
    {
        $this->requestSender = $requestSender;
    }
}
