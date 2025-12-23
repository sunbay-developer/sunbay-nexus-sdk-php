<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Enum;

/**
 * Authentication method enum
 *
 * @author Andy Li
 * @since 2025-01-20
 */
enum AuthenticationMethod: string
{
    /**
     * Not authenticated
     */
    case NOT_AUTHENTICATED = 'NOT_AUTHENTICATED';

    /**
     * PIN authentication
     */
    case PIN = 'PIN';

    /**
     * Offline PIN
     */
    case OFFLINE_PIN = 'OFFLINE_PIN';

    /**
     * Bypass authentication
     */
    case BY_PASS = 'BY_PASS';

    /**
     * Signature authentication
     */
    case SIGNATURE = 'SIGNATURE';
}

