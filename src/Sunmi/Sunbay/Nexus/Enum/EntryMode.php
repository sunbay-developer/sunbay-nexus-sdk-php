<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Enum;

/**
 * Entry mode enum
 *
 * @author Andy Li
 * @since 2025-01-20
 */
enum EntryMode: string
{
    /**
     * Manual entry
     */
    case MANUAL = 'MANUAL';

    /**
     * Swipe card
     */
    case SWIPE = 'SWIPE';

    /**
     * Fallback swipe
     */
    case FALLBACK_SWIPE = 'FALLBACK_SWIPE';

    /**
     * Contact chip
     */
    case CONTACT = 'CONTACT';

    /**
     * Contactless
     */
    case CONTACTLESS = 'CONTACTLESS';
}

