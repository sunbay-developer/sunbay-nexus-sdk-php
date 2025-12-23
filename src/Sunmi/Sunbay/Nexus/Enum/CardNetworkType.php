<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Enum;

/**
 * Card network type enum
 *
 * @author Andy Li
 * @since 2025-01-20
 */
enum CardNetworkType: string
{
    /**
     * Credit card
     */
    case CREDIT = 'CREDIT';

    /**
     * Debit card
     */
    case DEBIT = 'DEBIT';

    /**
     * EBT (Electronic Benefit Transfer)
     */
    case EBT = 'EBT';

    /**
     * EGC (Electronic Gift Card)
     */
    case EGC = 'EGC';

    /**
     * Unknown card type
     */
    case UNKNOWN = 'UNKNOWN';
}

