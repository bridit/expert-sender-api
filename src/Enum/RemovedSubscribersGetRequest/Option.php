<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Enum\RemovedSubscribersGetRequest;

use MyCLabs\Enum\Enum;

/**
 * Option for GET RemovedSubscriber request
 *
 * @method static Option CUSTOMS()
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class Option extends Enum
{
    /**
     * Return all subscriber properties and some general information
     */
    const CUSTOMS = 'Customs';
}
