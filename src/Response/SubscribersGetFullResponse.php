<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Response;

use Pzelant\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use Pzelant\ExpertSenderApi\Model\SubscriberData;
use Pzelant\ExpertSenderApi\ResponseInterface;
use Pzelant\ExpertSenderApi\SubscriberDataParser;

/**
 * Full info about subscriber
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class SubscribersGetFullResponse extends SubscribersGetLongResponse
{
    /**
     * @var SubscriberDataParser Subscriber data parse
     */
    private $parser;

    /**
     * Constructor
     *
     * @param ResponseInterface $response Response of ExpertSender API
     */
    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        $this->parser = new SubscriberDataParser();
    }

    /**
     * Get subscriber's data
     *
     * @return SubscriberData Subscriber's data
     */
    public function getSubscriberData(): SubscriberData
    {
        if (!$this->isOk()) {
            throw TryToAccessDataFromErrorResponseException::createFromResponse($this);
        }

        return $this->parser->parse($this->getSimpleXml()->xpath('/ApiResponse/Data')[0]);
    }
}
