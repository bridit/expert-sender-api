<?php declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Services;

use Bridit\ExpertSenderApi\Model\SubscribersPostRequest\Value;
use Bridit\ExpertSenderApi\Model\SubscribersPostRequest\Options;
use Bridit\ExpertSenderApi\Model\SubscribersPostRequest\Property;
use Bridit\ExpertSenderApi\Model\SubscribersPostRequest\Identifier;
use Bridit\ExpertSenderApi\Model\SubscribersPostRequest\SubscriberInfo;
use Bridit\ExpertSenderApi\ValueObjects\Property as PropertyVO;
use Bridit\ExpertSenderApi\ValueObjects\Subscriber;
use Bridit\ExpertSenderApi\ValueObjects\SubscriberUpsertResponse;
use DateTime;
use Exception;

class SubscriberService extends AbstractService
{

  /**
   * @param Subscriber $subscriber
   * @return SubscriberUpsertResponse
   */
  public function upsert(Subscriber $subscriber): SubscriberUpsertResponse
  {

    $options = new Options(true, true);

    $response = $this->api
      ->subscribers()
      ->addOrEdit($this->getAddOrEditPayload($subscriber), $options);

    return new SubscriberUpsertResponse(
      success: $response->isOk(), httpCode: $response->getHttpStatusCode(),
      errorCode: $response->getErrorCode(), errorMessages: $response->getErrorMessages()
    );

  }

  /**
   * @param Subscriber $subscriber
   * @return SubscriberInfo[]
   */
  protected function getAddOrEditPayload(Subscriber $subscriber): array
  {
    $emailIdentifier = Identifier::createEmail($subscriber->email);

    $subscriberInfo = new SubscriberInfo($emailIdentifier, $subscriber->listId);
    $subscriberInfo->setAllowAddUserThatWasDeleted(true);
    $subscriberInfo->setAllowAddUserThatWasUnsubscribed(true);

    if (!empty($subscriber->customId)) {
      $subscriberInfo->setCustomSubscriberId($subscriber->customId);
    }

    if (!empty($subscriber->email)) {
      $subscriberInfo->setEmail($subscriber->email);
    }

    if (!empty($subscriber->name)) {
      $subscriberInfo->setName($subscriber->name);
      $subscriberInfo->setFirstName($subscriber->firstName());
      $subscriberInfo->setLastName($subscriber->lastName());
    }

    if (!empty($subscriber->phoneNumber)) {
      $subscriberInfo->setPhone($subscriber->phoneNumber);
    }

    foreach ($subscriber->properties as $property)
    {
      $this->addProperty($subscriberInfo, $property);
    }

    return [$subscriberInfo];
  }

  /**
   * @param SubscriberInfo $subscriberInfo
   * @param PropertyVO $property
   */
  protected function addProperty(SubscriberInfo &$subscriberInfo, PropertyVO $property): void
  {
    $value = match ($property->type)
    {
      'int', 'integer' => Value::createInt($property->value),
      'bool', 'boolean' => Value::createBoolean($property->value),
      'number', 'float', 'double' => Value::createDouble($property->value),
      'date', 'datetime', 'timestamp' => Value::createDateFromDateTime($this->getDatetimeValue($property->value)),
      default => Value::createString($property->value ?? ''),
    };

    $subscriberInfo->addProperty(new Property($property->id, $value));
  }

  /**
   * @param mixed|null $value
   * @return DateTime|null
   */
  protected function getDatetimeValue(mixed $value): ?DateTime
  {
    if ($value instanceof DateTime) {
      return $value;
    }

    if (is_int($value)) {
      return (new DateTime())->setTimestamp($value);
    }

    if (!is_string($value)) {
      return null;
    }

    try {
      return new DateTime($value);
    } catch (Exception) {
      return null;
    }
  }

}
