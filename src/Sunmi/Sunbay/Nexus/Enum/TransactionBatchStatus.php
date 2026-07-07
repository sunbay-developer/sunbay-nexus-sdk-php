<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Enum;

/**
 * Transaction batch settlement status enum.
 *
 * @author Andy Li
 * @since 2026-06-29
 */
enum TransactionBatchStatus: string
{
    /**
     * No batch settlement needed
     */
    case NB = 'NB';

    /**
     * Waiting for batch close
     */
    case UB = 'UB';

    /**
     * Batch closed
     */
    case BC = 'BC';
}
