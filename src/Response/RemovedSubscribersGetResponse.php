<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Response;

use Pzelant\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use Pzelant\ExpertSenderApi\Model\RemovedSubscribersGetResponse\RemovedSubscriber;
use Pzelant\ExpertSenderApi\ResponseInterface;
use Pzelant\ExpertSenderApi\SpecificXmlMethodResponse;
use Pzelant\ExpertSenderApi\SubscriberDataParser;

/**
 * Response with removed subscribers data
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class RemovedSubscribersGetResponse extends SpecificXmlMethodResponse
{
    /**
     * @var SubscriberDataParser Subscriber data parser
     */
    private $parser;

    /**
     * Constructor
     *
     * @param ResponseInterface $response Response
     */
    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);

        $this->parser = new SubscriberDataParser();
    }

    /**
     * Get removed subscribers
     *
     * @return RemovedSubscriber[]|\Generator Removed subscribers
     */
    public function getRemovedSubscribers(): \Generator
    {
        if (!$this->isOk()) {
            throw TryToAccessDataFromErrorResponseException::createFromResponse($this);
        }

        $nodes = $this->getSimpleXml()->xpath('/ApiResponse/Data/RemovedSubscribers/RemovedSubscriber');
        foreach ($nodes as $node) {
            $subscriberData = null;
            // check, if additional data exists
            if (strval($node->Id) !== '') {
                $subscriberData = $this->parser->parse($node);
            }

            yield new RemovedSubscriber(
                strval($node->Email),
                intval($node->ListId),
                new \DateTime(strval($node->UnsubscribedOn)),
                $subscriberData
            );
        }
    }
}
