<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Common;

use Sunmi\Sunbay\Nexus\Constant\ApiConstants;

/**
 * Base response
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class BaseResponse
{
    /**
     * Response code, 0 means success
     */
    private ?string $code = null;

    /**
     * Response message
     */
    private ?string $msg = null;

    /**
     * Trace ID for troubleshooting
     */
    private ?string $traceId = null;

    /**
     * Check if response is successful
     *
     * @return bool true if success
     */
    public function isSuccess(): bool
    {
        return ApiConstants::RESPONSE_SUCCESS_CODE === $this->code;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string|null $code
     * @return self
     */
    public function setCode(?string $code): self
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMsg(): ?string
    {
        return $this->msg;
    }

    /**
     * @param string|null $msg
     * @return self
     */
    public function setMsg(?string $msg): self
    {
        $this->msg = $msg;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTraceId(): ?string
    {
        return $this->traceId;
    }

    /**
     * @param string|null $traceId
     * @return self
     */
    public function setTraceId(?string $traceId): self
    {
        $this->traceId = $traceId;
        return $this;
    }
}
