<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Response;

use Sunmi\Sunbay\Nexus\Model\Common\BaseResponse;
use Sunmi\Sunbay\Nexus\Model\Common\OnlineRefundAmount;

/**
 * Online refund response (POST /v1/checkout/refund).
 *
 * @author Andy Li
 * @since 2026-06-29
 */
class OnlineRefundResponse extends BaseResponse
{
    private ?string $transactionId = null;
    private ?string $transactionRequestId = null;
    private ?string $originalTransactionId = null;
    private ?string $transactionStatus = null;
    private ?string $transactionType = null;
    private ?OnlineRefundAmount $amount = null;
    private ?string $createTime = null;
    private ?string $completeTime = null;
    private ?string $transactionResultCode = null;
    private ?string $transactionResultMsg = null;
    private ?string $description = null;

    public function getTransactionId(): ?string { return $this->transactionId; }
    public function setTransactionId(?string $transactionId): self { $this->transactionId = $transactionId; return $this; }

    public function getTransactionRequestId(): ?string { return $this->transactionRequestId; }
    public function setTransactionRequestId(?string $transactionRequestId): self { $this->transactionRequestId = $transactionRequestId; return $this; }

    public function getOriginalTransactionId(): ?string { return $this->originalTransactionId; }
    public function setOriginalTransactionId(?string $originalTransactionId): self { $this->originalTransactionId = $originalTransactionId; return $this; }

    public function getTransactionStatus(): ?string { return $this->transactionStatus; }
    public function setTransactionStatus(?string $transactionStatus): self { $this->transactionStatus = $transactionStatus; return $this; }

    public function getTransactionType(): ?string { return $this->transactionType; }
    public function setTransactionType(?string $transactionType): self { $this->transactionType = $transactionType; return $this; }

    public function getAmount(): ?OnlineRefundAmount { return $this->amount; }
    public function setAmount(?OnlineRefundAmount $amount): self { $this->amount = $amount; return $this; }

    public function getCreateTime(): ?string { return $this->createTime; }
    public function setCreateTime(?string $createTime): self { $this->createTime = $createTime; return $this; }

    public function getCompleteTime(): ?string { return $this->completeTime; }
    public function setCompleteTime(?string $completeTime): self { $this->completeTime = $completeTime; return $this; }

    public function getTransactionResultCode(): ?string { return $this->transactionResultCode; }
    public function setTransactionResultCode(?string $transactionResultCode): self { $this->transactionResultCode = $transactionResultCode; return $this; }

    public function getTransactionResultMsg(): ?string { return $this->transactionResultMsg; }
    public function setTransactionResultMsg(?string $transactionResultMsg): self { $this->transactionResultMsg = $transactionResultMsg; return $this; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): self { $this->description = $description; return $this; }
}
