<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Enum;

/**
 * Online direct checkout wallet payment method (POST /v1/checkout/sale).
 *
 * @author Andy Li
 * @since 2026-01-28
 */
enum OnlineWalletPaymentMethod: string
{
    case GOOGLE_PAY = 'GOOGLE_PAY';
    case APPLE_PAY = 'APPLE_PAY';
}
