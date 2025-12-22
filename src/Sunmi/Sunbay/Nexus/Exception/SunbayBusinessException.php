<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Exception;

/**
 * Sunbay SDK business exception
 *
 * Used for API business exceptions and parameter validation errors
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class SunbayBusinessException extends \Exception
{
    /**
     * API error code (for API exceptions)
     */
    protected ?string $errorCode = null;

    /**
     * Trace ID (for API exceptions)
     */
    private ?string $traceId = null;

    /**
     * Create API exception with code and traceId
     *
     * @param string $code API error code
     * @param string $message error message
     * @param string|null $traceId trace ID
     */
    public function __construct(string $code, string $message, ?string $traceId = null)
    {
        parent::__construct($message, 0);
        $this->errorCode = $code;
        $this->traceId = $traceId;
    }

    /**
     * Get API error code
     *
     * @return string|null
     */
    public function getErrorCode(): ?string
    {
        return $this->errorCode;
    }

    /**
     * Get trace ID
     *
     * @return string|null
     */
    public function getTraceId(): ?string
    {
        return $this->traceId;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        if ($this->errorCode !== null) {
            return sprintf(
                'SunbayBusinessException{code=\'%s\', message=\'%s\', traceId=\'%s\'}',
                $this->errorCode,
                $this->getMessage(),
                $this->traceId ?? ''
            );
        }
        return sprintf('SunbayBusinessException{message=\'%s\'}', $this->getMessage());
    }
}

