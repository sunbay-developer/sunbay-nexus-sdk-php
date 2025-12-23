<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Enum;

/**
 * Payment category enum
 *
 * @author Andy Li
 * @since 2025-01-20
 */
enum PaymentCategory: string
{
    /**
     * Card payment
     */
    case CARD = 'CARD';

    /**
     * Credit card network
     */
    case CARD_CREDIT = 'CARD-CREDIT';

    /**
     * Debit card network
     */
    case CARD_DEBIT = 'CARD-DEBIT';

    /**
     * QR code merchant presented mode
     */
    case QR_MPM = 'QR-MPM';

    /**
     * QR code customer presented mode
     */
    case QR_CPM = 'QR-CPM';
}

