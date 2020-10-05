<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi;

/**
 * Abstract resource
 *
 * @author Nikita Sapogov <sapogov.n@Pzelant.ru>
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
