<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Request;

use Sunmi\Sunbay\Nexus\Model\Common\OnlineRefundAmount;

/**
 * Online refund request (POST /v1/checkout/refund).
 *
 * Either originalTransactionId or originalTransactionRequestId must be provided
 * to identify the original transaction to refund.
 *
 * @author Andy Li
 * @since 2026-06-29
 */
class OnlineRefundRequest
{
    public function __construct(
        ?string $appId = null,
        ?string $merchantId = null,
        ?string $transactionRequestId = null,
        ?string $originalTransactionId = null,
        ?string $originalTransactionRequestId = null,
        ?OnlineRefundAmount $amount = null,
        ?string $description = null,
        ?string $attach = null,
        ?string $notifyUrl = null
    ) {
        if ($appId !== null) $this->setAppId($appId);
        if ($merchantId !== null) $this->setMerchantId($merchantId);
        if ($transactionRequestId !== null) $this->setTransactionRequestId($transactionRequestId);
        if ($originalTransactionId !== null) $this->setOriginalTransactionId($originalTransactionId);
        if ($originalTransactionRequestId !== null) $this->setOriginalTransactionRequestId($originalTransactionRequestId);
        if ($amount !== null) $this->setAmount($amount);
        if ($description !== null) $this->setDescription($description);
        if ($attach !== null) $this->setAttach($attach);
        if ($notifyUrl !== null) $this->setNotifyUrl($notifyUrl);
    }

    private ?string $appId = null;
    private ?string $merchantId = null;
    private ?string $transactionRequestId = null;
    private ?string $originalTransactionId = null;
    private ?string $originalTransactionRequestId = null;
    private ?OnlineRefundAmount $amount = null;
    private ?string $description = null;
    private ?string $attach = null;
    private ?string $notifyUrl = null;

    public function getAppId(): ?string { return $this->appId; }
    public function setAppId(?string $appId): self { $this->appId = $appId; return $this; }

    public function getMerchantId(): ?string { return $this->merchantId; }
    public function setMerchantId(?string $merchantId): self { $this->merchantId = $merchantId; return $this; }

    public function getTransactionRequestId(): ?string { return $this->transactionRequestId; }
    public function setTransactionRequestId(?string $transactionRequestId): self { $this->transactionRequestId = $transactionRequestId; return $this; }

    public function getOriginalTransactionId(): ?string { return $this->originalTransactionId; }
    public function setOriginalTransactionId(?string $originalTransactionId): self { $this->originalTransactionId = $originalTransactionId; return $this; }

    public function getOriginalTransactionRequestId(): ?string { return $this->originalTransactionRequestId; }
    public function setOriginalTransactionRequestId(?string $originalTransactionRequestId): self { $this->originalTransactionRequestId = $originalTransactionRequestId; return $this; }

    public function getAmount(): ?OnlineRefundAmount { return $this->amount; }
    public function setAmount(?OnlineRefundAmount $amount): self { $this->amount = $amount; return $this; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): self { $this->description = $description; return $this; }

    public function getAttach(): ?string { return $this->attach; }
    public function setAttach(?string $attach): self { $this->attach = $attach; return $this; }

    public function getNotifyUrl(): ?string { return $this->notifyUrl; }
    public function setNotifyUrl(?string $notifyUrl): self { $this->notifyUrl = $notifyUrl; return $this; }

    public static function builder(): OnlineRefundRequestBuilder
    {
        return new OnlineRefundRequestBuilder();
    }
}

class OnlineRefundRequestBuilder
{
    private OnlineRefundRequest $request;

    public function __construct()
    {
        $this->request = new OnlineRefundRequest();
    }

    public function appId(?string $appId): self { $this->request->setAppId($appId); return $this; }
    public function merchantId(?string $merchantId): self { $this->request->setMerchantId($merchantId); return $this; }
    public function transactionRequestId(?string $transactionRequestId): self { $this->request->setTransactionRequestId($transactionRequestId); return $this; }
    public function originalTransactionId(?string $originalTransactionId): self { $this->request->setOriginalTransactionId($originalTransactionId); return $this; }
    public function originalTransactionRequestId(?string $originalTransactionRequestId): self { $this->request->setOriginalTransactionRequestId($originalTransactionRequestId); return $this; }
    public function amount(?OnlineRefundAmount $amount): self { $this->request->setAmount($amount); return $this; }
    public function description(?string $description): self { $this->request->setDescription($description); return $this; }
    public function attach(?string $attach): self { $this->request->setAttach($attach); return $this; }
    public function notifyUrl(?string $notifyUrl): self { $this->request->setNotifyUrl($notifyUrl); return $this; }

    public function build(): OnlineRefundRequest
    {
        return $this->request;
    }
}
