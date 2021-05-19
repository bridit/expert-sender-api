<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Response\ActivitiesGetResponse;

use Bridit\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use Bridit\ExpertSenderApi\Model\ActivitiesGetResponse\GoalActivity;
use Bridit\ExpertSenderApi\SpecificCsvMethodResponse;

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
            throw TryToAccessDataFromErrorResponseException::createFromResponse($this);
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
