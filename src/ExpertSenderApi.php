<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi;

use Bridit\ExpertSenderApi\Enum\BouncesGetRequest\BounceType;
use Bridit\ExpertSenderApi\Request\BouncesGetRequest;
use Bridit\ExpertSenderApi\Request\TimeGetRequest;
use Bridit\ExpertSenderApi\Resource\DataTablesResource;
use Bridit\ExpertSenderApi\Resource\MessagesResource;
use Bridit\ExpertSenderApi\Resource\SubscribersResource;
use Bridit\ExpertSenderApi\Response\BouncesGetResponse;
use Bridit\ExpertSenderApi\Response\TimeGetResponse;

/**
 * Expert Sender API
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class ExpertSenderApi
{
    /**
     * @var RequestSenderInterface Request sender
     */
    private $requestSender;

    /**
     * Constructor.
     *
     * @param RequestSenderInterface $requestSender Request sender
     */
    public function __construct(RequestSenderInterface $requestSender)
    {
        $this->requestSender = $requestSender;
    }

    /**
     * Get Subscribers resource
     *
     * @return SubscribersResource Subscribers resource
     */
    public function subscribers(): SubscribersResource
    {
        return new SubscribersResource($this->requestSender);
    }

    /**
     * Get server time response
     *
     * @return TimeGetResponse Server time response
     */
    public function getServerTime(): TimeGetResponse
    {
        return new TimeGetResponse($this->requestSender->send(new TimeGetRequest()));
    }

    /**
     * Get bounces data
     *
     * @param \DateTime $startDate Start date
     * @param \DateTime $endDate End date
     * @param BounceType|null $bounceType Bounce type
     *
     * @return BouncesGetResponse Bounces data
     */
    public function getBouncesList(
        \DateTime $startDate,
        \DateTime $endDate,
        BounceType $bounceType = null
    ): BouncesGetResponse {
        return new BouncesGetResponse(
            $this->requestSender->send(new BouncesGetRequest($startDate, $endDate, $bounceType))
        );
    }

    /**
     * Get data tables resource
     *
     * @return DataTablesResource Data tables resource
     */
    public function dataTables(): DataTablesResource
    {
        return new DataTablesResource($this->requestSender);
    }

    /**
     * Get messages resource
     *
     * @return MessagesResource Messages resource
     */
    public function messages(): MessagesResource
    {
        return new MessagesResource($this->requestSender);
    }
}
