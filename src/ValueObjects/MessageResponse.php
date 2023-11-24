<?php declare(strict_types=1);

namespace Bridit\ExpertSenderApi\ValueObjects;

class MessageResponse
{

  public function __construct(
    public string               $email,
    public bool                 $success,
    public int                  $httpStatusCode,
    public ?string              $guid,
    public MessageResponseError $error,
  )
  {
    //
  }

  public function toArray(): array
  {
    return [
      'email' => $this->email,
      'success' => $this->success,
      'http_status_code' => $this->httpStatusCode,
      'guid' => $this->guid,
      'error' => $this->error->toArray(),
    ];
  }

}
