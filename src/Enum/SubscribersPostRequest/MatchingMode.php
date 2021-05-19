<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Enum\SubscribersPostRequest;

use MyCLabs\Enum\Enum;

/**
 * Matching mode
 *
 * This mod choose which data should use as primary key
 *
 * @method static MatchingMode EMAIL()
 * @method static MatchingMode CUSTOMER_SUBSCRIBER_ID()
 * @method static MatchingMode ID()
 * @method static MatchingMode PHONE()
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
final class MatchingMode extends Enum
{
    /**
     * Email
     */
    const EMAIL = 'Email';

    /**
     * Custom subscriber ID
     */
    const CUSTOMER_SUBSCRIBER_ID = 'CustomSubscriberId';

    /**
     * Subscriber ID
     */
    const ID = 'Id';

    /**
     * Subscriber's phone
     */
    const PHONE = 'Phone';
}
