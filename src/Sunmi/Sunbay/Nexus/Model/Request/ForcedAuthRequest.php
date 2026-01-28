<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Request;

use Sunmi\Sunbay\Nexus\Enum\PrintReceiptOption;
use Sunmi\Sunbay\Nexus\Model\Common\AuthAmount;
use Sunmi\Sunbay\Nexus\Model\Common\PaymentMethodInfo;

/**
 * Forced authorization request
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class ForcedAuthRequest
{
    private ?string $appId = null;
    private ?string $merchantId = null;
    private ?string $referenceOrderId = null;
    private ?string $transactionRequestId = null;
    private ?AuthAmount $amount = null;
    private ?PaymentMethodInfo $paymentMethod = null;
    private ?string $description = null;
    private ?string $terminalSn = null;
    private ?string $attach = null;
    private ?string $notifyUrl = null;
    private ?string $timeExpire = null;
    /** Receipt print option. NONE/MERCHANT/CUSTOMER/BOTH. Default: NONE */
    private ?PrintReceiptOption $printReceipt = null;

    // Getters and setters
    public function getAppId(): ?string { return $this->appId; }
    public function setAppId(?string $appId): self { $this->appId = $appId; return $this; }

    public function getMerchantId(): ?string { return $this->merchantId; }
    public function setMerchantId(?string $merchantId): self { $this->merchantId = $merchantId; return $this; }

    public function getReferenceOrderId(): ?string { return $this->referenceOrderId; }
    public function setReferenceOrderId(?string $referenceOrderId): self { $this->referenceOrderId = $referenceOrderId; return $this; }

    public function getTransactionRequestId(): ?string { return $this->transactionRequestId; }
    public function setTransactionRequestId(?string $transactionRequestId): self { $this->transactionRequestId = $transactionRequestId; return $this; }

    public function getAmount(): ?AuthAmount { return $this->amount; }
    public function setAmount(?AuthAmount $amount): self { $this->amount = $amount; return $this; }

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

    public function getPrintReceipt(): ?PrintReceiptOption { return $this->printReceipt; }
    public function setPrintReceipt(?PrintReceiptOption $printReceipt): self { $this->printReceipt = $printReceipt; return $this; }

    public static function builder(): ForcedAuthRequestBuilder
    {
        return new ForcedAuthRequestBuilder();
    }
}

class ForcedAuthRequestBuilder
{
    private ForcedAuthRequest $forcedAuthRequest;

    public function __construct()
    {
        $this->forcedAuthRequest = new ForcedAuthRequest();
    }

    public function appId(?string $appId): self { $this->forcedAuthRequest->setAppId($appId); return $this; }
    public function merchantId(?string $merchantId): self { $this->forcedAuthRequest->setMerchantId($merchantId); return $this; }
    public function referenceOrderId(?string $referenceOrderId): self { $this->forcedAuthRequest->setReferenceOrderId($referenceOrderId); return $this; }
    public function transactionRequestId(?string $transactionRequestId): self { $this->forcedAuthRequest->setTransactionRequestId($transactionRequestId); return $this; }
    public function amount(?AuthAmount $amount): self { $this->forcedAuthRequest->setAmount($amount); return $this; }
    public function paymentMethod(?PaymentMethodInfo $paymentMethod): self { $this->forcedAuthRequest->setPaymentMethod($paymentMethod); return $this; }
    public function description(?string $description): self { $this->forcedAuthRequest->setDescription($description); return $this; }
    public function terminalSn(?string $terminalSn): self { $this->forcedAuthRequest->setTerminalSn($terminalSn); return $this; }
    public function attach(?string $attach): self { $this->forcedAuthRequest->setAttach($attach); return $this; }
    public function notifyUrl(?string $notifyUrl): self { $this->forcedAuthRequest->setNotifyUrl($notifyUrl); return $this; }
    public function timeExpire(?string $timeExpire): self { $this->forcedAuthRequest->setTimeExpire($timeExpire); return $this; }
    public function printReceipt(?PrintReceiptOption $printReceipt): self { $this->forcedAuthRequest->setPrintReceipt($printReceipt); return $this; }

    public function build(): ForcedAuthRequest
    {
        return $this->forcedAuthRequest;
    }
}

