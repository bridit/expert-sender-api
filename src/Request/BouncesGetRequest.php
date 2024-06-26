<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Request;

use Bridit\ExpertSenderApi\Enum\BouncesGetRequest\BounceType;
use Bridit\ExpertSenderApi\Enum\HttpMethod;
use Bridit\ExpertSenderApi\RequestInterface;

/**
 * Request for GET /Api/Bounces
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class BouncesGetRequest implements RequestInterface
{
    /**
     * @var \DateTime Start date
     */
    private $startDate;

    /**
     * @var \DateTime End data
     */
    private $endDate;

    /**
     * @var BounceType|null Bounce type
     */
    private $bounceType;

    /**
     * Constructor.
     *
     * @param \DateTime $startDate Start date
     * @param \DateTime $endDate End data
     * @param BounceType $bounceType Bounce type
     */
    public function __construct(\DateTime $startDate, \DateTime $endDate, BounceType $bounceType = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->bounceType = $bounceType;
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
        $params = [
            'startDate' => $this->startDate->format('Y-m-d'),
            'endDate' => $this->endDate->format('Y-m-d'),
        ];

        if ($this->bounceType !== null) {
            $params['bounceType'] = $this->bounceType->getValue();
        }

        return $params;
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
        return '/v2/Api/Bounces';
    }
}
