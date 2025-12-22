<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Exception;

/**
 * Sunbay network exception
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class SunbayNetworkException extends \Exception
{
    private bool $retryable;

    /**
     * @param string $message error message
     * @param bool $retryable whether the request is retryable
     * @param \Throwable|null $previous previous exception
     */
    public function __construct(string $message, bool $retryable = false, ?\Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
        $this->retryable = $retryable;
    }

    /**
     * Check if the request is retryable
     *
     * @return bool
     */
    public function isRetryable(): bool
    {
        return $this->retryable;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            'SunbayNetworkException{message=\'%s\', retryable=%s}',
            $this->getMessage(),
            $this->retryable ? 'true' : 'false'
        );
    }
}

