<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Enum;

/**
 * Transaction status enum
 *
 * @author Andy Li
 * @since 2025-01-20
 */
enum TransactionStatus: string
{
    /**
     * Initial state
     */
    case INITIAL = 'INITIAL';

    /**
     * Transaction processing. Channel called but no result obtained, or unexpected exception returned.
     */
    case PROCESSING = 'PROCESSING';

    /**
     * Transaction successful
     */
    case SUCCESS = 'SUCCESS';

    /**
     * Transaction failed
     */
    case FAIL = 'FAIL';

    /**
     * Transaction closed
     */
    case CLOSED = 'CLOSED';

    /**
     * Get status code (single character)
     *
     * @return string
     */
    public function getCode(): string
    {
        return match ($this) {
            self::INITIAL => 'I',
            self::PROCESSING => 'P',
            self::SUCCESS => 'S',
            self::FAIL => 'F',
            self::CLOSED => 'C',
        };
    }

    /**
     * Get status description
     *
     * @return string
     */
    public function getDesc(): string
    {
        return $this->value;
    }
}

