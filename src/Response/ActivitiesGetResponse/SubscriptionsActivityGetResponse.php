<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Response\ActivitiesGetResponse;

use Bridit\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use Bridit\ExpertSenderApi\Model\ActivitiesGetResponse\SubscriptionActivity;
use Bridit\ExpertSenderApi\SpecificCsvMethodResponse;

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
            throw TryToAccessDataFromErrorResponseException::createFromResponse($this);
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
