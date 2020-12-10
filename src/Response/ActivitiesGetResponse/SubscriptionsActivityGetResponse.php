<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Response\ActivitiesGetResponse;

use Pzelant\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use Pzelant\ExpertSenderApi\Model\ActivitiesGetResponse\SubscriptionActivity;
use Pzelant\ExpertSenderApi\SpecificCsvMethodResponse;

/**
 * Response with subscription activities
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class SubscriptionsActivityGetResponse extends SpecificCsvMethodResponse
{
    /**
     * Get subscriptions
     *
     * @return SubscriptionActivity[]|iterable Subscriptions
     */
    public function getSubscriptions(): iterable
    {
        if (!$this->isOk()) {
            throw new TryToAccessDataFromErrorResponseException($this);
        }

        foreach ($this->getCsvReader()->fetchAll() as $row) {
            yield new SubscriptionActivity(
                $row['Email'],
                new \DateTime($row['Date']),
                intval($row['ListId']),
                $row['ListName']
            );
        }
    }
}
