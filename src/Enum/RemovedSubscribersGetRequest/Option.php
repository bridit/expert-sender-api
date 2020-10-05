<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Enum\RemovedSubscribersGetRequest;

use MyCLabs\Enum\Enum;

/**
 * Option for GET RemovedSubscriber request
 *
 * @method static Option CUSTOMS()
 *
 * @author Nikita Sapogov <sapogov.n@Pzelant.ru>
 */
class Option extends Enum
{
    /**
     * Return all subscriber properties and some general information
     */
    const CUSTOMS = 'Customs';
}
