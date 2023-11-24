<?php declare(strict_types=1);

namespace Bridit\ExpertSenderApi\ValueObjects;

class Property
{

  public function __construct(
    public int    $id,
    public string $type,
    public mixed  $value
  )
  {
    //
  }

}
