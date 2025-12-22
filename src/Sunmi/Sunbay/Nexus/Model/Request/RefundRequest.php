<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Request;

use Sunmi\Sunbay\Nexus\Model\Common\PaymentMethodInfo;
use Sunmi\Sunbay\Nexus\Model\Common\RefundAmount;

/**
 * Refund request
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class RefundRequest
{
    private ?string $appId = null;
    private ?string $merchantId = null;
    private ?string $originalTransactionId = null;
    private ?string $originalTransactionRequestId = null;
    private ?string $referenceOrderId = null;
    private ?string $transactionRequestId = null;
    private ?RefundAmount $amount = null;
    private ?PaymentMethodInfo $paymentMethod = null;
    private ?string $description = null;
    private ?string $terminalSn = null;
    private ?string $attach = null;
    private ?string $notifyUrl = null;
    private ?string $timeExpire = null;

    // Getters and setters
    public function getAppId(): ?string { return $this->appId; }
    public function setAppId(?string $appId): self { $this->appId = $appId; return $this; }

    public function getMerchantId(): ?string { return $this->merchantId; }
    public function setMerchantId(?string $merchantId): self { $this->merchantId = $merchantId; return $this; }

    public function getOriginalTransactionId(): ?string { return $this->originalTransactionId; }
    public function setOriginalTransactionId(?string $originalTransactionId): self { $this->originalTransactionId = $originalTransactionId; return $this; }

    public function getOriginalTransactionRequestId(): ?string { return $this->originalTransactionRequestId; }
    public function setOriginalTransactionRequestId(?string $originalTransactionRequestId): self { $this->originalTransactionRequestId = $originalTransactionRequestId; return $this; }

    public function getReferenceOrderId(): ?string { return $this->referenceOrderId; }
    public function setReferenceOrderId(?string $referenceOrderId): self { $this->referenceOrderId = $referenceOrderId; return $this; }

    public function getTransactionRequestId(): ?string { return $this->transactionRequestId; }
    public function setTransactionRequestId(?string $transactionRequestId): self { $this->transactionRequestId = $transactionRequestId; return $this; }

    public function getAmount(): ?RefundAmount { return $this->amount; }
    public function setAmount(?RefundAmount $amount): self { $this->amount = $amount; return $this; }

    public function getPaymentMethod(): ?PaymentMethodInfo { return $this->paymentMethod; }
    public function setPaymentMethod(?PaymentMethodInfo $paymentMethod): self { $this->paymentMethod = $paymentMethod; return $this; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): self { $this->description = $description; return $this; }

    public function getTerminalSn(): ?string { return $this->terminalSn; }
    public function setTerminalSn(?string $terminalSn): self { $this->terminalSn = $terminalSn; return $this; }

    public function getAttach(): ?string { return $this->attach; }
    public function setAttach(?string $attach): self { $this->attach = $attach; return $this; }

    public function getNotifyUrl(): ?string { return $this->notifyUrl; }
    public function setNotifyUrl(?string $notifyUrl): self { $this->notifyUrl = $notifyUrl; return $this; }

    public function getTimeExpire(): ?string { return $this->timeExpire; }
    public function setTimeExpire(?string $timeExpire): self { $this->timeExpire = $timeExpire; return $this; }

    public static function builder(): RefundRequestBuilder
    {
        return new RefundRequestBuilder();
    }
}

class RefundRequestBuilder
{
    private RefundRequest $refundRequest;

    public function __construct()
    {
        $this->refundRequest = new RefundRequest();
    }

    public function appId(?string $appId): self { $this->refundRequest->setAppId($appId); return $this; }
    public function merchantId(?string $merchantId): self { $this->refundRequest->setMerchantId($merchantId); return $this; }
    public function originalTransactionId(?string $originalTransactionId): self { $this->refundRequest->setOriginalTransactionId($originalTransactionId); return $this; }
    public function originalTransactionRequestId(?string $originalTransactionRequestId): self { $this->refundRequest->setOriginalTransactionRequestId($originalTransactionRequestId); return $this; }
    public function referenceOrderId(?string $referenceOrderId): self { $this->refundRequest->setReferenceOrderId($referenceOrderId); return $this; }
    public function transactionRequestId(?string $transactionRequestId): self { $this->refundRequest->setTransactionRequestId($transactionRequestId); return $this; }
    public function amount(?RefundAmount $amount): self { $this->refundRequest->setAmount($amount); return $this; }
    public function paymentMethod(?PaymentMethodInfo $paymentMethod): self { $this->refundRequest->setPaymentMethod($paymentMethod); return $this; }
    public function description(?string $description): self { $this->refundRequest->setDescription($description); return $this; }
    public function terminalSn(?string $terminalSn): self { $this->refundRequest->setTerminalSn($terminalSn); return $this; }
    public function attach(?string $attach): self { $this->refundRequest->setAttach($attach); return $this; }
    public function notifyUrl(?string $notifyUrl): self { $this->refundRequest->setNotifyUrl($notifyUrl); return $this; }
    public function timeExpire(?string $timeExpire): self { $this->refundRequest->setTimeExpire($timeExpire); return $this; }

    public function build(): RefundRequest
    {
        return $this->refundRequest;
    }
}

