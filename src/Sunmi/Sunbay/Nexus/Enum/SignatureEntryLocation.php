<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Enum;

/**
 * Signature entry location enum
 *
 * @author Andy Li
 * @since 2026-07-07
 */
enum SignatureEntryLocation: string
{
    /**
     * Terminal screen signature
     */
    case ON_SCREEN = 'ON_SCREEN';

    /**
     * Receipt signature
     */
    case ON_RECEIPT = 'ON_RECEIPT';
}
