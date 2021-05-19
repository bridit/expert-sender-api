<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Response\ActivitiesGetResponse;

use Bridit\ExpertSenderApi\Enum\ActivitiesGetRequest\BounceReason;
use Bridit\ExpertSenderApi\Exception\TryToAccessDataFromErrorResponseException;
use Bridit\ExpertSenderApi\Model\ActivitiesGetResponse\BounceActivity;
use Bridit\ExpertSenderApi\SpecificCsvMethodResponse;

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
   * @throws \Exception
   */
  public function getBounces(): iterable
  {
    if (!$this->isOk()) {
      throw TryToAccessDataFromErrorResponseException::createFromResponse($this);
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
