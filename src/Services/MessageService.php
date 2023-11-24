<?php declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Services;

use Bridit\ExpertSenderApi\Model\TransactionalPostRequest\Receiver;
use Bridit\ExpertSenderApi\Model\TransactionalPostRequest\Snippet;
use Bridit\ExpertSenderApi\ValueObjects\MessageResponse;
use Bridit\ExpertSenderApi\ValueObjects\MessageResponseError;

class MessageService extends AbstractService
{

  public function send(string $email, int $messageId, ?array $snippets = []): MessageResponse
  {
    $receiver = Receiver::createWithEmail($email);

    $response = $this->api
      ->messages()
      ->sendTransactionalMessage(
        transactionMessageId: $messageId,
        receiver: $receiver,
        snippets: $this->getSnippets(snippets: $snippets),
        returnGuid: true
      );

    return new MessageResponse(
      email: $email,
      success: $response->isOk(),
      httpStatusCode: $response->getHttpStatusCode(),
      guid: $response->isOk() ? $response->getGuid() : null,
      error: new MessageResponseError(
        code: $response->getErrorCode(),
        messages: $response->getErrorMessages(),
      ),
    );
  }

  private function getSnippets(?array $snippets = []): array
  {
    return array_map(fn($item) => new Snippet(name: $item['name'], value: $item['value']), $snippets);
  }

}
