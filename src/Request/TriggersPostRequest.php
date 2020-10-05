<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Request;

use Pzelant\ExpertSenderApi\Enum\HttpMethod;
use Pzelant\ExpertSenderApi\Model\TriggersPostRequest\Receiver;
use Pzelant\ExpertSenderApi\RequestInterface;
use Webmozart\Assert\Assert;

/**
 * Request for POST Triggers
 *
 * @author Nikita Sapogov <sapogov.n@Pzelant.ru>
 */
class TriggersPostRequest implements RequestInterface
{
    /**
     * @var int Trigger message ID
     */
    private $triggerMessageId;

    /**
     * @var Receiver[] Receivers
     */
    private $receivers;

    /**
     * Constructor
     *
     * @param int $triggerMessageId Trigger message ID
     * @param Receiver[] $receivers Receivers
     */
    public function __construct($triggerMessageId, array $receivers)
    {
        Assert::notEmpty($triggerMessageId);
        Assert::notEmpty($receivers);
        Assert::allIsInstanceOf($receivers, Receiver::class);
        $this->triggerMessageId = $triggerMessageId;
        $this->receivers = $receivers;
    }

    /**
     * {@inheritdoc}
     */
    public function toXml(): string
    {
        $xmlWriter = new \XMLWriter();
        $xmlWriter->openMemory();
        $xmlWriter->startElement('Data');
        $xmlWriter->writeAttributeNS('xsi', 'type', null, 'TriggerReceivers');
        $xmlWriter->startElement('Receivers');
        foreach ($this->receivers as $receiver) {
            $xmlWriter->startElement('Receiver');
            if (!empty($receiver->getId())) {
                $xmlWriter->writeElement('Id', strval($receiver->getId()));
            }

            if (!empty($receiver->getEmail())) {
                $xmlWriter->writeElement('Email', $receiver->getEmail());
            }

            $xmlWriter->endElement(); // Receiver
        }

        $xmlWriter->endElement(); // Receivers
        $xmlWriter->endElement(); // Data

        return $xmlWriter->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getQueryParams(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getMethod(): HttpMethod
    {
        return HttpMethod::POST();
    }

    /**
     * {@inheritdoc}
     */
    public function getUri(): string
    {
        return '/v2/Api/Triggers/' . $this->triggerMessageId;
    }
}
