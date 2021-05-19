<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Response\ActivitiesGetResponse;

use Pzelant\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use Pzelant\ExpertSenderApi\Model\ActivitiesGetResponse\OpenActivity;
use Pzelant\ExpertSenderApi\SpecificCsvMethodResponse;

/**
 * Response with opens activity
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class OpensActivityGetResponse extends SpecificCsvMethodResponse
{
    /**
     * Get open activities
     *
     * @return OpenActivity[]|iterable Open activities
     */
    public function getOpens(): iterable
    {
        if (!$this->isOk()) {
            throw TryToAccessDataFromErrorResponseException::createFromResponse($this);
        }

        foreach ($this->getCsvReader()->fetchAll() as $row) {
            yield new OpenActivity(
                $row['Email'],
                new \DateTime($row['Date']),
                intval($row['MessageId']),
                $row['MessageSubject'],
                isset($row['ListId']) ? intval($row['ListId']) : null,
                $row['ListName'] ?? null,
                $row['MessageGuid'] ?? null
            );
        }
    }
}
