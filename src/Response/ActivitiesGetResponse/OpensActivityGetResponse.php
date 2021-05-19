<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Response\ActivitiesGetResponse;

use Bridit\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use Bridit\ExpertSenderApi\Model\ActivitiesGetResponse\OpenActivity;
use Bridit\ExpertSenderApi\SpecificCsvMethodResponse;

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
