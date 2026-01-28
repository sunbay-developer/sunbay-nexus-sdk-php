<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Request;

use Sunmi\Sunbay\Nexus\Enum\PrintReceiptOption;
use Sunmi\Sunbay\Nexus\Model\Common\AuthAmount;
use Sunmi\Sunbay\Nexus\Model\Common\PaymentMethodInfo;

/**
 * Authorization request
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class AuthRequest
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

    public static function builder(): AuthRequestBuilder
    {
        return new AuthRequestBuilder();
    }
}

class AuthRequestBuilder
{
    private AuthRequest $authRequest;

    public function __construct()
    {
        $this->authRequest = new AuthRequest();
    }

    public function appId(?string $appId): self { $this->authRequest->setAppId($appId); return $this; }
    public function merchantId(?string $merchantId): self { $this->authRequest->setMerchantId($merchantId); return $this; }
    public function referenceOrderId(?string $referenceOrderId): self { $this->authRequest->setReferenceOrderId($referenceOrderId); return $this; }
    public function transactionRequestId(?string $transactionRequestId): self { $this->authRequest->setTransactionRequestId($transactionRequestId); return $this; }
    public function amount(?AuthAmount $amount): self { $this->authRequest->setAmount($amount); return $this; }
    public function paymentMethod(?PaymentMethodInfo $paymentMethod): self { $this->authRequest->setPaymentMethod($paymentMethod); return $this; }
    public function description(?string $description): self { $this->authRequest->setDescription($description); return $this; }
    public function terminalSn(?string $terminalSn): self { $this->authRequest->setTerminalSn($terminalSn); return $this; }
    public function attach(?string $attach): self { $this->authRequest->setAttach($attach); return $this; }
    public function notifyUrl(?string $notifyUrl): self { $this->authRequest->setNotifyUrl($notifyUrl); return $this; }
    public function timeExpire(?string $timeExpire): self { $this->authRequest->setTimeExpire($timeExpire); return $this; }
    public function printReceipt(?PrintReceiptOption $printReceipt): self { $this->authRequest->setPrintReceipt($printReceipt); return $this; }

    public function build(): AuthRequest
    {
        return $this->authRequest;
    }
}

