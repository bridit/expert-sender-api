<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Response\ActivitiesGetResponse;

use Pzelant\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use Pzelant\ExpertSenderApi\Model\ActivitiesGetResponse\SendActivity;
use Pzelant\ExpertSenderApi\SpecificCsvMethodResponse;

/**
 * Response with sends activity
 *
 * @author Nikita Sapogov <sapogov.n@Pzelant.ru>
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
            throw new TryToAccessDataFromErrorResponseException($this);
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
