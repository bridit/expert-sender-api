<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Response\ActivitiesGetResponse;

use Pzelant\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use Pzelant\ExpertSenderApi\Model\ActivitiesGetResponse\GoalActivity;
use Pzelant\ExpertSenderApi\SpecificCsvMethodResponse;

/**
 * Goal activity get response
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class GoalsActivityGetResponse extends SpecificCsvMethodResponse
{
    /**
     * Get goal activities
     *
     * @return GoalActivity[]|iterable Goal activities
     */
    public function getGoals(): iterable
    {
        if (!$this->isOk()) {
            throw new TryToAccessDataFromErrorResponseException($this);
        }

        foreach ($this->getCsvReader()->fetchAll() as $row) {
            yield new GoalActivity(
                $row['Email'],
                new \DateTime($row['Date']),
                intval($row['MessageId']),
                $row['MessageSubject'],
                intval($row['GoalValue']),
                isset($row['ListId']) ? intval($row['ListId']) : null,
                $row['ListName'] ?? null,
                $row['MessageGuid'] ?? null
            );
        }
    }
}
