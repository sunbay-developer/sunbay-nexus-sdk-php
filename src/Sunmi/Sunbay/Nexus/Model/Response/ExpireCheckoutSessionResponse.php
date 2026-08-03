<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Response;

use Sunmi\Sunbay\Nexus\Model\Common\BaseResponse;

/**
 * Response for POST /v1/checkout/expire-session.
 *
 * @author Andy Li
 * @since 2026-08-03
 */
class ExpireCheckoutSessionResponse extends BaseResponse
{
    private ?string $sessionId = null;
    private ?string $sessionStatus = null;
    private ?string $transactionId = null;
    private ?string $transactionRequestId = null;
    private ?string $expiredAt = null;

    public function getSessionId(): ?string { return $this->sessionId; }
    public function setSessionId(?string $sessionId): self { $this->sessionId = $sessionId; return $this; }

    public function getSessionStatus(): ?string { return $this->sessionStatus; }
    public function setSessionStatus(?string $sessionStatus): self { $this->sessionStatus = $sessionStatus; return $this; }

    public function getTransactionId(): ?string { return $this->transactionId; }
    public function setTransactionId(?string $transactionId): self { $this->transactionId = $transactionId; return $this; }

    public function getTransactionRequestId(): ?string { return $this->transactionRequestId; }
    public function setTransactionRequestId(?string $transactionRequestId): self { $this->transactionRequestId = $transactionRequestId; return $this; }

    public function getExpiredAt(): ?string { return $this->expiredAt; }
    public function setExpiredAt(?string $expiredAt): self { $this->expiredAt = $expiredAt; return $this; }
}
