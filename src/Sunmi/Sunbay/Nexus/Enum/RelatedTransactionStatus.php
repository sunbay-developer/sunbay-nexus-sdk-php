<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Enum;

/**
 * Related transaction status enum.
 * Indicates the lifecycle change of the current transaction due to subsequent transactions.
 *
 * @author Andy Li
 * @since 2026-06-29
 */
enum RelatedTransactionStatus: string
{
    /**
     * Transaction has been voided
     */
    case VOIDED = 'VOIDED';

    /**
     * Transaction has incremental authorization
     */
    case INCREMENTAL = 'INCREMENTAL';

    /**
     * Transaction has been fully refunded
     */
    case REFUNDED = 'REFUNDED';

    /**
     * Transaction has been captured (post-auth)
     */
    case CAPTURE = 'CAPTURE';

    /**
     * Transaction has been partially refunded
     */
    case PART_REFUNDED = 'PART_REFUNDED';
}
