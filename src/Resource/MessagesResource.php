<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Resource;

use Bridit\ExpertSenderApi\AbstractResource;
use Bridit\ExpertSenderApi\Model\TransactionalPostRequest\Attachment;
use Bridit\ExpertSenderApi\Model\TransactionalPostRequest\Snippet;
use Bridit\ExpertSenderApi\Model\TriggersPostRequest\Receiver;
use Bridit\ExpertSenderApi\Model\TransactionalPostRequest\Receiver as TransactionalReceiver;
use Bridit\ExpertSenderApi\Request\SystemTransactionalPostRequest;
use Bridit\ExpertSenderApi\Request\TransactionalPostRequest;
use Bridit\ExpertSenderApi\Request\TriggersPostRequest;
use Bridit\ExpertSenderApi\Response\TransactionalPostResponse;
use Bridit\ExpertSenderApi\ResponseInterface;

/**
 * Messages resource
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
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
