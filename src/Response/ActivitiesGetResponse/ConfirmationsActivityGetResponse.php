<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Response\ActivitiesGetResponse;

use Bridit\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use Bridit\ExpertSenderApi\Model\ActivitiesGetResponse\ConfirmationActivity;
use Bridit\ExpertSenderApi\SpecificCsvMethodResponse;

/**
 * Response with confirmation activities
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
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
            throw TryToAccessDataFromErrorResponseException::createFromResponse($this);
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
