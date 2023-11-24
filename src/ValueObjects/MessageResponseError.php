<?php declare(strict_types=1);

namespace Bridit\ExpertSenderApi\ValueObjects;

use Bridit\ExpertSenderApi\Model\ErrorMessage;

class MessageResponseError
{

  /**
   * @param int|null $code
   * @param ErrorMessage[]|null $messages
   */
  public function __construct(
    public ?int $code = null,
    public ?array $messages = null)
  {
    //
  }

  public function toArray(): array
  {
    return [
      'code' => $this->code,
      'messages' => array_map(fn(ErrorMessage $errorMessage) => $errorMessage->getMessage(), $this->messages ?? []),
    ];
  }

}
