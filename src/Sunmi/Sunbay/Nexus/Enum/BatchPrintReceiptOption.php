<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Enum;

/**
 * Batch close report print option
 *
 * @author Andy Li
 * @since 2026-08-06
 */
enum BatchPrintReceiptOption: string
{
    /**
     * Print batch summary only
     */
    case TOTAL = 'TOTAL';

    /**
     * Print batch detail (per-transaction)
     */
    case DETAIL = 'DETAIL';

    /**
     * Print both summary and detail
     */
    case BOTH = 'BOTH';

    /**
     * Do not print batch report
     */
    case NONE = 'NONE';

    /**
     * Use SUNBAY platform configuration
     */
    case AUTO = 'AUTO';
}
