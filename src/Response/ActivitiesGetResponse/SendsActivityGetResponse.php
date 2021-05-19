<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Response\ActivitiesGetResponse;

use Bridit\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use Bridit\ExpertSenderApi\Model\ActivitiesGetResponse\SendActivity;
use Bridit\ExpertSenderApi\SpecificCsvMethodResponse;

/**
 * Response with sends activity
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class SendsActivityGetResponse extends SpecificCsvMethodResponse
{
    /**
     * Get send activities
     *
     * @return SendActivity[]|iterable Send activities
     */
    public function getSends(): iterable
    {
        if (!$this->isOk()) {
            throw TryToAccessDataFromErrorResponseException::createFromResponse($this);
        }

        foreach ($this->getCsvReader()->fetchAll() as $row) {
            yield new SendActivity(
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
