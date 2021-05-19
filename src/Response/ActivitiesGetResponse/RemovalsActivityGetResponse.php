<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Response\ActivitiesGetResponse;

use Bridit\ExpertSenderApi\Enum\ActivitiesGetRequest\RemovalReason;
use Bridit\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use Bridit\ExpertSenderApi\Model\ActivitiesGetResponse\RemovalActivity;
use Bridit\ExpertSenderApi\SpecificCsvMethodResponse;

/**
 * Removals activity get response
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class RemovalsActivityGetResponse extends SpecificCsvMethodResponse
{
    /**
     * Get removal activities
     *
     * @return RemovalActivity[]|iterable Removal activities
     */
    public function getRemovals(): iterable
    {
        if (!$this->isOk()) {
            throw TryToAccessDataFromErrorResponseException::createFromResponse($this);
        }

        foreach ($this->getCsvReader()->fetchAll() as $row) {
            yield new RemovalActivity(
                $row['Email'],
                new \DateTime($row['Date']),
                intval($row['MessageId']),
                $row['MessageSubject'],
                new RemovalReason($row['Reason']),
                isset($row['ListId']) ? intval($row['ListId']) : null,
                $row['ListName'] ?? null,
                $row['MessageGuid'] ?? null
            );
        }
    }
}
