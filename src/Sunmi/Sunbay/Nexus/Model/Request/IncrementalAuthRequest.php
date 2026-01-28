<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Request;

use Sunmi\Sunbay\Nexus\Enum\PrintReceiptOption;
use Sunmi\Sunbay\Nexus\Model\Common\AuthAmount;

/**
 * Incremental authorization request
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class IncrementalAuthRequest
{
    private ?string $appId = null;
    private ?string $merchantId = null;
    private ?string $originalTransactionId = null;
    private ?string $originalTransactionRequestId = null;
    private ?string $transactionRequestId = null;
    private ?AuthAmount $amount = null;
    private ?string $description = null;
    private ?string $terminalSn = null;
    private ?string $attach = null;
    private ?string $notifyUrl = null;
    /** Receipt print option. NONE/MERCHANT/CUSTOMER/BOTH. Default: NONE */
    private ?PrintReceiptOption $printReceipt = null;

    // Getters and setters
    public function getAppId(): ?string { return $this->appId; }
    public function setAppId(?string $appId): self { $this->appId = $appId; return $this; }

    public function getMerchantId(): ?string { return $this->merchantId; }
    public function setMerchantId(?string $merchantId): self { $this->merchantId = $merchantId; return $this; }

    public function getOriginalTransactionId(): ?string { return $this->originalTransactionId; }
    public function setOriginalTransactionId(?string $originalTransactionId): self { $this->originalTransactionId = $originalTransactionId; return $this; }

    public function getOriginalTransactionRequestId(): ?string { return $this->originalTransactionRequestId; }
    public function setOriginalTransactionRequestId(?string $originalTransactionRequestId): self { $this->originalTransactionRequestId = $originalTransactionRequestId; return $this; }

    public function getTransactionRequestId(): ?string { return $this->transactionRequestId; }
    public function setTransactionRequestId(?string $transactionRequestId): self { $this->transactionRequestId = $transactionRequestId; return $this; }

    public function getAmount(): ?AuthAmount { return $this->amount; }
    public function setAmount(?AuthAmount $amount): self { $this->amount = $amount; return $this; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): self { $this->description = $description; return $this; }

    public function getTerminalSn(): ?string { return $this->terminalSn; }
    public function setTerminalSn(?string $terminalSn): self { $this->terminalSn = $terminalSn; return $this; }

    public function getAttach(): ?string { return $this->attach; }
    public function setAttach(?string $attach): self { $this->attach = $attach; return $this; }

    public function getNotifyUrl(): ?string { return $this->notifyUrl; }
    public function setNotifyUrl(?string $notifyUrl): self { $this->notifyUrl = $notifyUrl; return $this; }

    public function getPrintReceipt(): ?PrintReceiptOption { return $this->printReceipt; }
    public function setPrintReceipt(?PrintReceiptOption $printReceipt): self { $this->printReceipt = $printReceipt; return $this; }

    public static function builder(): IncrementalAuthRequestBuilder
    {
        return new IncrementalAuthRequestBuilder();
    }
}

class IncrementalAuthRequestBuilder
{
    private IncrementalAuthRequest $incrementalAuthRequest;

    public function __construct()
    {
        $this->incrementalAuthRequest = new IncrementalAuthRequest();
    }

    public function appId(?string $appId): self { $this->incrementalAuthRequest->setAppId($appId); return $this; }
    public function merchantId(?string $merchantId): self { $this->incrementalAuthRequest->setMerchantId($merchantId); return $this; }
    public function originalTransactionId(?string $originalTransactionId): self { $this->incrementalAuthRequest->setOriginalTransactionId($originalTransactionId); return $this; }
    public function originalTransactionRequestId(?string $originalTransactionRequestId): self { $this->incrementalAuthRequest->setOriginalTransactionRequestId($originalTransactionRequestId); return $this; }
    public function transactionRequestId(?string $transactionRequestId): self { $this->incrementalAuthRequest->setTransactionRequestId($transactionRequestId); return $this; }
    public function amount(?AuthAmount $amount): self { $this->incrementalAuthRequest->setAmount($amount); return $this; }
    public function description(?string $description): self { $this->incrementalAuthRequest->setDescription($description); return $this; }
    public function terminalSn(?string $terminalSn): self { $this->incrementalAuthRequest->setTerminalSn($terminalSn); return $this; }
    public function attach(?string $attach): self { $this->incrementalAuthRequest->setAttach($attach); return $this; }
    public function notifyUrl(?string $notifyUrl): self { $this->incrementalAuthRequest->setNotifyUrl($notifyUrl); return $this; }
    public function printReceipt(?PrintReceiptOption $printReceipt): self { $this->incrementalAuthRequest->setPrintReceipt($printReceipt); return $this; }

    public function build(): IncrementalAuthRequest
    {
        return $this->incrementalAuthRequest;
    }
}

