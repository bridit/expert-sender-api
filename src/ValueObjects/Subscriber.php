<?php declare(strict_types=1);

namespace Bridit\ExpertSenderApi\ValueObjects;

class Subscriber
{

  /**
   * @param int|null $listId
   * @param string|null $email
   * @param string|null $name
   * @param string|null $phoneNumber
   * @param string|null $customId
   * @param Property[]|null $properties
   */
  public function __construct(
    public ?int    $listId,
    public ?string $email,
    public ?string $name,
    public ?string $phoneNumber,
    public ?string $customId,
    public ?array  $properties
  )
  {
    //
  }

  public function firstName(): string
  {
    return explode(' ', $this->name)[0] ?? '';
  }

  public function lastName(): string
  {
    return array_reverse(explode(' ', $this->name))[0] ?? '';
  }

}
