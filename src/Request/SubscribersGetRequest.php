<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Request;

use Pzelant\ExpertSenderApi\Enum\HttpMethod;
use Pzelant\ExpertSenderApi\Enum\SubscribersGetRequest\DataOption;
use Pzelant\ExpertSenderApi\RequestInterface;
use Webmozart\Assert\Assert;

/**
 * Request for get subscriber info
 *
 * @author Nikita Sapogov <sapogov.n@Pzelant.ru>
 */
class SubscribersGetRequest implements RequestInterface
{
    /**
     * @var string Email
     */
    private $email;

    /**
     * @var DataOption DataType of response
     */
    private $option;

    /**
     * Constructor
     *
     * @param string $email Email
     * @param DataOption $option DataType of response
     */
    public function __construct(string $email, DataOption $option)
    {
        Assert::notEmpty($email);
        $this->email = $email;
        $this->option = $option;
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
    public function getMethod(): HttpMethod
    {
        return HttpMethod::GET();
    }

    /**
     * {@inheritdoc}
     */
    public function getUri(): string
    {
        return '/v2/Api/Subscribers';
    }

    /**
     * {@inheritdoc}
     */
    public function getQueryParams(): array
    {
        return ['email' => $this->email, 'option' => $this->option->getValue()];
    }
}
