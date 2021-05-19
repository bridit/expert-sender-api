<?php
declare(strict_types=1);

namespace Bridit\ExpertSenderApi\Enum\DataTablesDeleteRowsPostRequest;

use MyCLabs\Enum\Enum;

/**
 * Filter operator
 *
 * @method static FilterOperator EQ()
 * @method static FilterOperator GT()
 * @method static FilterOperator LT()
 * @method static FilterOperator GE()
 * @method static FilterOperator LE()
 *
 * @author Nikita Sapogov <p.zelant@gmail.com>
 */
class FilterOperator extends Enum
{
    /**
     * Equals
     */
    const EQ = 'EQ';

    /**
     * Greater than
     */
    const GT = 'GT';

    /**
     * Less than
     */
    const LT = 'LT';

    /**
     * Greater or equals
     */
    const GE = 'GE';

    /**
     * Less or equals
     */
    const LE = 'LE';
}
