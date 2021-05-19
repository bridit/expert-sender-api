<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Response\ActivitiesGetResponse;

use Bridit\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use Bridit\ExpertSenderApi\Model\ActivitiesGetResponse\ComplaintActivity;
use Bridit\ExpertSenderApi\SpecificCsvMethodResponse;

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
            throw TryToAccessDataFromErrorResponseException::createFromResponse($this);
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
