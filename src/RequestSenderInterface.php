<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi;

/**
 * Expert Sender request sender
 *
 * @author Nikita Sapogov <sapogov.n@Pzelant.ru>
 */
interface RequestSenderInterface
{
    /**
     * Send request
     *
     * @param RequestInterface $request Request
     *
     * @return ResponseInterface Response
     */
    public function send(RequestInterface $request): ResponseInterface;
}
