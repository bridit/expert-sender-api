<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Resource;

use Pzelant\ExpertSenderApi\AbstractResource;
use Pzelant\ExpertSenderApi\Model\TransactionalPostRequest\Attachment;
use Pzelant\ExpertSenderApi\Model\TransactionalPostRequest\Snippet;
use Pzelant\ExpertSenderApi\Model\TriggersPostRequest\Receiver;
use Pzelant\ExpertSenderApi\Model\TransactionalPostRequest\Receiver as TransactionalReceiver;
use Pzelant\ExpertSenderApi\Request\SystemTransactionalPostRequest;
use Pzelant\ExpertSenderApi\Request\TransactionalPostRequest;
use Pzelant\ExpertSenderApi\Request\TriggersPostRequest;
use Pzelant\ExpertSenderApi\Response\TransactionalPostResponse;
use Pzelant\ExpertSenderApi\ResponseInterface;

/**
 * Messages resource
 *
 * @author Nikita Sapogov <sapogov.n@Pzelant.ru>
 */
class MessagesResource extends AbstractResource
{
    /**
     * Send trigger message
     *
     * @param int $triggerMessageId Trigger message ID
     * @param Receiver[] $receivers Receivers
     *
     * @return ResponseInterface Response
     */
    public function sendTriggerMessage(int $triggerMessageId, array $receivers): ResponseInterface
    {
        return $this->requestSender->send(new TriggersPostRequest($triggerMessageId, $receivers));
    }

    /**
     * Send transactional message
     *
     * @param int $transactionMessageId Transaction message ID
     * @param TransactionalReceiver $receiver Receiver
     * @param Snippet[] $snippets Snippets
     * @param Attachment[] $attachments Attachments
     * @param bool $returnGuid Should return GUID in Response
     *
     * @return TransactionalPostResponse Response
     */
    public function sendTransactionalMessage(
        int $transactionMessageId,
        TransactionalReceiver $receiver,
        array $snippets = [],
        array $attachments = [],
        bool $returnGuid = false
    ): TransactionalPostResponse {
        return new TransactionalPostResponse(
            $this->requestSender->send(
                new TransactionalPostRequest(
                    $transactionMessageId, $receiver, $snippets, $attachments, $returnGuid
                )
            )
        );
    }

    /**
     * Send system transactional message
     *
     * @param int $transactionMessageId Transaction message ID
     * @param TransactionalReceiver $receiver Receiver
     * @param Snippet[] $snippets Snippets
     * @param Attachment[] $attachments Attachments
     * @param bool $returnGuid Should return GUID in Response
     *
     * @return TransactionalPostResponse Response
     */
    public function sendSystemTransactionalMessage(
        int $transactionMessageId,
        TransactionalReceiver $receiver,
        array $snippets = [],
        array $attachments = [],
        bool $returnGuid = false
    ): TransactionalPostResponse {
        return new TransactionalPostResponse(
            $this->requestSender->send(
                new SystemTransactionalPostRequest(
                    $transactionMessageId, $receiver, $snippets, $attachments, $returnGuid
                )
            )
        );
    }
}
