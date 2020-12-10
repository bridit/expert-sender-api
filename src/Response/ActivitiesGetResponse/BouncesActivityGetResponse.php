<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Response\ActivitiesGetResponse;

use Pzelant\ExpertSenderApi\Enum\ActivitiesGetRequest\BounceReason;
use Pzelant\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use Pzelant\ExpertSenderApi\Model\ActivitiesGetResponse\BounceActivity;
use Pzelant\ExpertSenderApi\SpecificCsvMethodResponse;

/**
 * Bounces activity get response
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class BouncesActivityGetResponse extends SpecificCsvMethodResponse
{
    /**
     * Get removal activities
     *
     * @return BounceActivity[]|iterable Removal activities
     */
    public function getBounces(): iterable
    {
        if (!$this->isOk()) {
            throw new TryToAccessDataFromErrorResponseException($this);
        }

        foreach ($this->getCsvReader()->fetchAll() as $row) {
            yield new BounceActivity(
                $row['Email'],
                new \DateTime($row['Date']),
                new BounceReason($row['Reason']),
                $row['DiagnosticCode'],
                isset($row['ListId']) ? intval($row['ListId']) : null,
                $row['ListName'] ?? null,
                $row['MessageGuid'] ?? null
            );
        }
    }
}
