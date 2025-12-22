<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Util;

/**
 * ID generator utility
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class IdGenerator
{
    private function __construct()
    {
    }

    /**
     * Generate UUID
     *
     * @return string UUID string
     */
    public static function generateUUID(): string
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }

    /**
     * Generate request ID
     *
     * @return string request ID
     */
    public static function generateRequestId(): string
    {
        return self::generateUUID();
    }
}

