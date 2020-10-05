<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Request;

use Pzelant\ExpertSenderApi\Model\TransactionalPostRequest\Attachment;
use Pzelant\ExpertSenderApi\Model\TransactionalPostRequest\Snippet;
use Pzelant\ExpertSenderApi\Enum\HttpMethod;
use Pzelant\ExpertSenderApi\Model\TransactionalPostRequest\Receiver;
use Pzelant\ExpertSenderApi\Utils;
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
