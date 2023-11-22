<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Request;

use Bridit\ExpertSenderApi\Enum\HttpMethod;
use Bridit\ExpertSenderApi\RequestInterface;
use Webmozart\Assert\Assert;

/**
 * Request for GET Message Preview
 *
 * @author Gustavo Siqueira <gus@brid-it.com>
 */
class MessagePreviewRequest implements RequestInterface
{
    /**
     * @var int Message ID
     */
    private int $messageId;

    /**
     * Constructor
     *
     * @param int $messageId Message ID
     */
    public function __construct(int $messageId)
    {
        $this->messageId = $messageId;
    }

    /**
     * {@inheritdoc}
     */
    public function toXml(): string
    {
      return '';
    }

    /**
     * {@inheritdoc}
     */
    public function getQueryParams(): array
    {
        return [
          'Id' => $this->messageId,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getMethod(): HttpMethod
    {
        return HttpMethod::GET();
    }

    /**
     * {@inheritdoc}
     */
    public function getUri(): string
    {
        return '/v2/Api/MessagePreview';
    }
}
