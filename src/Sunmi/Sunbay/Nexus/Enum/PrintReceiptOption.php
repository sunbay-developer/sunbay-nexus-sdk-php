<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Enum;

/**
 * Print receipt option
 *
 * @author Andy Li
 * @since 2025-01-28
 */
enum PrintReceiptOption: string
{
    /**
     * Do not print receipt
     */
    case NONE = 'NONE';

    /**
     * Print merchant copy only
     */
    case MERCHANT = 'MERCHANT';

    /**
     * Print customer copy only
     */
    case CUSTOMER = 'CUSTOMER';

    /**
     * Print both merchant and customer copies
     */
    case BOTH = 'BOTH';
}
