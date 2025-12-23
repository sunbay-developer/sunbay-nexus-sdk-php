<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Enum;

/**
 * Transaction type enum
 *
 * @author Andy Li
 * @since 2025-01-20
 */
enum TransactionType: string
{
    /**
     * Sale transaction
     */
    case SALE = 'SALE';

    /**
     * Authorization (pre-auth)
     */
    case AUTH = 'AUTH';

    /**
     * Forced authorization
     */
    case FORCED_AUTH = 'FORCED_AUTH';

    /**
     * Incremental authorization
     */
    case INCREMENTAL = 'INCREMENTAL';

    /**
     * Post authorization (pre-auth completion)
     */
    case POST_AUTH = 'POST_AUTH';

    /**
     * Refund
     */
    case REFUND = 'REFUND';

    /**
     * Void
     */
    case VOID = 'VOID';
}

