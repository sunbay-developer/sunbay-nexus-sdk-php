<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Response;

use Sunmi\Sunbay\Nexus\Model\Common\BaseResponse;

/**
 * Response for POST /v1/checkout/sale (direct online payment).
 *
 * @author Andy Li
 * @since 2026-01-28
 */
class CheckoutSaleResponse extends BaseResponse
{
    private ?string $transactionId = null;
    private ?string $referenceOrderId = null;
    private ?string $transactionRequestId = null;

    public function getTransactionId(): ?string
    {
        return $this->transactionId;
    }

    public function setTransactionId(?string $transactionId): self
    {
        $this->transactionId = $transactionId;
        return $this;
    }

    public function getReferenceOrderId(): ?string
    {
        return $this->referenceOrderId;
    }

    public function setReferenceOrderId(?string $referenceOrderId): self
    {
        $this->referenceOrderId = $referenceOrderId;
        return $this;
    }

    public function getTransactionRequestId(): ?string
    {
        return $this->transactionRequestId;
    }

    public function setTransactionRequestId(?string $transactionRequestId): self
    {
        $this->transactionRequestId = $transactionRequestId;
        return $this;
    }
}
