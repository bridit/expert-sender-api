<?php declare(strict_types=1);

namespace Bridit\ExpertSenderApi\ValueObjects;

use Bridit\ExpertSenderApi\Model\ErrorMessage;

class SubscriberUpsertResponse
{

  public function __construct(
    public ?bool  $success,
    public ?int   $httpCode,
    public ?int   $errorCode,
    public ?array $errorMessages,
  )
  {}

  public function toArray(): array
  {
    return [
      'success' => $this->success,
      'http_code' => $this->httpCode,
      'error_code' => $this->errorCode,
      'error_messages' => array_map(fn(ErrorMessage $errorMessage) => $errorMessage->getMessage(), $this->errorMessages),
    ];
  }
}
