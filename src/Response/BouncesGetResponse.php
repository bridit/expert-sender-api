<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Response;

use Pzelant\ExpertSenderApi\Enum\BouncesGetResponse\BounceType;
use Pzelant\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use Pzelant\ExpertSenderApi\Model\BouncesGetResponse\Bounce;
use Pzelant\ExpertSenderApi\SpecificCsvMethodResponse;

/**
 * Bounces data
 *
 * @author Nikita Sapogov <sapogov.n@Pzelant.ru>
 */
class BouncesGetResponse extends SpecificCsvMethodResponse
{
    /**
     * Get bounces
     *
     * @return Bounce[]|\Generator Bounces
     */
    public function getBounces(): \Generator
    {
        if (!$this->isOk()) {
            throw TryToAccessDataFromErrorResponseException::createFromResponse($this);
        }

        foreach ($this->getCsvReader()->fetchAll() as $row) {
            yield new Bounce(
                new \DateTime($row['Date']),
                $row['Email'],
                $row['BounceCode'],
                new BounceType($row['BounceType'])
            );
        }
    }
}
