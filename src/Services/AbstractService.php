<?php declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Services;

use Bridit\ExpertSenderApi\ExpertSenderApi;
use Bridit\ExpertSenderApi\RequestSender;
use GuzzleHttp\Client;

abstract class AbstractService
{

  protected ExpertSenderApi $api;

  public function __construct(protected string $url, protected string $key)
  {
    $httpClient = new Client(['base_uri' => $url]);
    $requestSender = new RequestSender($httpClient, $key);

    $this->api = new ExpertSenderApi($requestSender);
  }

}
