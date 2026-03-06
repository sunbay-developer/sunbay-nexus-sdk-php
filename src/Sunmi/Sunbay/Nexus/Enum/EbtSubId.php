<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Enum;

/**
 * EBT sub-payment type. Only valid when paymentMethod.category=EBT and paymentMethod.id=EBT.
 *
 * @author Andy Li
 * @since 2025-01-28
 */
enum EbtSubId: string
{
    case SNAP = 'SNAP';
    case VOUCHER = 'VOUCHER';
    case BENEFIT = 'BENEFIT';
}
