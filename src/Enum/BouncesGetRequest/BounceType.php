<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Enum\BouncesGetRequest;

use MyCLabs\Enum\Enum;

/**
 * Bounce type
 *
 * @method static BounceType USER_UNKNOWN()
 * @method static BounceType MAILBOX_FULL()
 * @method static BounceType BLOCKED()
 * @method static BounceType UNKNOWN()
 * @method static BounceType OTHER()
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class BounceType extends Enum
{
    /**
     * Email does not exist
     */
    const USER_UNKNOWN = 1;

    /**
     * Mailbox is full or otherwise temporary inaccessible
     */
    const MAILBOX_FULL = 2;

    /**
     * Message blocked, usually for spam-related reasons
     */
    const BLOCKED = 3;

    /**
     * Unknown reason when bounce cannot be classified
     */
    const UNKNOWN = 6;

    /**
     * Other bounce reason. This category contains transport-related issues, mail server bugs etc
     */
    const OTHER = 7;
}
