<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Response\ActivitiesGetResponse;

use Pzelant\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use Pzelant\ExpertSenderApi\Model\ActivitiesGetResponse\ComplaintActivity;
use Pzelant\ExpertSenderApi\SpecificCsvMethodResponse;

/**
 * Complaint activity get response
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class ComplaintsActivityGetResponse extends SpecificCsvMethodResponse
{
    /**
     * Get complaint activities
     *
     * @return ComplaintActivity[]|iterable Complaint activities
     */
    public function getComplaints(): iterable
    {
        if (!$this->isOk()) {
            throw new TryToAccessDataFromErrorResponseException($this);
        }

        foreach ($this->getCsvReader()->fetchAll() as $row) {
            yield new ComplaintActivity(
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
