<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Request;

use Bridit\ExpertSenderApi\Model\TransactionalPostRequest\Attachment;
use Bridit\ExpertSenderApi\Model\TransactionalPostRequest\Snippet;
use Bridit\ExpertSenderApi\Enum\HttpMethod;
use Bridit\ExpertSenderApi\Model\TransactionalPostRequest\Receiver;
use Bridit\ExpertSenderApi\Utils;
use Webmozart\Assert\Assert;

/**
 * Send system transactional message request
 *
 * @author Igor Bozhennikov <bozhennikov.i@Pzelant.ru>
 */
class SystemTransactionalPostRequest extends TransactionalPostRequest
{
    /**
     * {@inheritdoc}
     */
    public function getUri(): string
    {
        return '/v2/Api/SystemTransactionals/' . $this->transactionMessageId;
    }
}
