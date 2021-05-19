<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Response;

use Bridit\ExpertSenderApi\Enum\BouncesGetResponse\BounceType;
use Bridit\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use Bridit\ExpertSenderApi\Model\BouncesGetResponse\Bounce;
use Bridit\ExpertSenderApi\SpecificCsvMethodResponse;

/**
 * Bounces data
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
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
