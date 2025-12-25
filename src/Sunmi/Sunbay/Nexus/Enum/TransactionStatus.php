<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Enum;

/**
 * Transaction status enum
 * 
 * Interface returns code (single character), desc is for display only
 *
 * @author Andy Li
 * @since 2025-01-20
 */
enum TransactionStatus: string
{
    /**
     * Initial state (code: I, desc: INITIAL)
     */
    case INITIAL = 'I';

    /**
     * Transaction processing. Channel called but no result obtained, or unexpected exception returned. (code: P, desc: PROCESSING)
     */
    case PROCESSING = 'P';

    /**
     * Transaction successful (code: S, desc: SUCCESS)
     */
    case SUCCESS = 'S';

    /**
     * Transaction failed (code: F, desc: FAIL)
     */
    case FAIL = 'F';

    /**
     * Transaction closed (code: C, desc: CLOSED)
     */
    case CLOSED = 'C';
}

