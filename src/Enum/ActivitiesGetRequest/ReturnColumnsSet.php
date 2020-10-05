<?php
declare(strict_types=1);

namespace Pzelant\ExpertSenderApi\Enum\ActivitiesGetRequest;

use MyCLabs\Enum\Enum;

/**
 * Column set to return in response
 *
 * @method static ReturnColumnsSet STANDARD()
 * @method static ReturnColumnsSet EXTENDED()
 *
 * @author Nikita Sapogov <sapogov.n@Pzelant.ru>
 */
final class ReturnColumnsSet extends Enum
{
    /**
     * Default set
     */
    const STANDARD = 'Standard';

    /**
     * Additional columns are returned in the response
     */
    const EXTENDED = 'Extended';
}
