<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Response\ActivitiesGetResponse;

use Pzelant\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use Pzelant\ExpertSenderApi\Model\ActivitiesGetResponse\ConfirmationActivity;
use Pzelant\ExpertSenderApi\SpecificCsvMethodResponse;

/**
 * Response with confirmation activities
 *
 * @author Nikita Sapogov <sapogov.n@Pzelant.ru>
 */
class ConfirmationsActivityGetResponse extends SpecificCsvMethodResponse
{
    /**
     * Get subscriptions
     *
     * @return ConfirmationActivity[]|iterable Subscriptions
     */
    public function getConfirmations(): iterable
    {
        if (!$this->isOk()) {
            throw new TryToAccessDataFromErrorResponseException($this);
        }

        foreach ($this->getCsvReader()->fetchAll() as $row) {
            yield new ConfirmationActivity(
                $row['Email'],
                new \DateTime($row['Date']),
                intval($row['ListId']),
                $row['ListName']
            );
        }
    }
}
