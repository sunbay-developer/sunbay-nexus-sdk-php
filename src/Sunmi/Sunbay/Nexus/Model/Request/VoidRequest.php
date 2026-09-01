<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Request;

use Sunmi\Sunbay\Nexus\Enum\PrintReceiptOption;

/**
 * Void request
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class VoidRequest
{
    public function __construct(
        ?string $appId = null,
        ?string $merchantId = null,
        ?string $originalTransactionId = null,
        ?string $originalTransactionRequestId = null,
        ?string $transactionRequestId = null,
        ?string $description = null,
        ?string $terminalSn = null,
        ?string $attach = null,
        ?string $notifyUrl = null,
        ?PrintReceiptOption $printReceipt = null,
        ?bool $pushToTerminal = null,
        ?string $terminalEventNotifyUrl = null
    ) {
        if ($appId !== null) $this->setAppId($appId);
        if ($merchantId !== null) $this->setMerchantId($merchantId);
        if ($originalTransactionId !== null) $this->setOriginalTransactionId($originalTransactionId);
        if ($originalTransactionRequestId !== null) $this->setOriginalTransactionRequestId($originalTransactionRequestId);
        if ($transactionRequestId !== null) $this->setTransactionRequestId($transactionRequestId);
        if ($description !== null) $this->setDescription($description);
        if ($terminalSn !== null) $this->setTerminalSn($terminalSn);
        if ($attach !== null) $this->setAttach($attach);
        if ($notifyUrl !== null) $this->setNotifyUrl($notifyUrl);
        if ($printReceipt !== null) $this->setPrintReceipt($printReceipt);
        if ($pushToTerminal !== null) $this->setPushToTerminal($pushToTerminal);
        if ($terminalEventNotifyUrl !== null) $this->setTerminalEventNotifyUrl($terminalEventNotifyUrl);
    }

    private ?string $appId = null;
    private ?string $merchantId = null;
    private ?string $originalTransactionId = null;
    private ?string $originalTransactionRequestId = null;
    private ?string $transactionRequestId = null;
    private ?string $description = null;
    private ?string $terminalSn = null;
    private ?string $attach = null;
    private ?string $notifyUrl = null;
    /** Receipt print option. NONE/MERCHANT/CUSTOMER/BOTH. Default: NONE */
    private ?PrintReceiptOption $printReceipt = null;
    /** Whether to push the transaction to the terminal. Default: true */
    private ?bool $pushToTerminal = null;
    /** Terminal event async notify URL. Receive real-time terminal status events (card swipe, signature, print, etc.) during a transaction */
    private ?string $terminalEventNotifyUrl = null;

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

    public function getPushToTerminal(): ?bool { return $this->pushToTerminal; }
    public function setPushToTerminal(?bool $pushToTerminal): self { $this->pushToTerminal = $pushToTerminal; return $this; }

    public function getTerminalEventNotifyUrl(): ?string { return $this->terminalEventNotifyUrl; }
    public function setTerminalEventNotifyUrl(?string $terminalEventNotifyUrl): self { $this->terminalEventNotifyUrl = $terminalEventNotifyUrl; return $this; }

    public static function builder(): VoidRequestBuilder
    {
        return new VoidRequestBuilder();
    }
}

class VoidRequestBuilder
{
    private VoidRequest $voidRequest;

    public function __construct()
    {
        $this->voidRequest = new VoidRequest();
    }

    public function appId(?string $appId): self { $this->voidRequest->setAppId($appId); return $this; }
    public function merchantId(?string $merchantId): self { $this->voidRequest->setMerchantId($merchantId); return $this; }
    public function originalTransactionId(?string $originalTransactionId): self { $this->voidRequest->setOriginalTransactionId($originalTransactionId); return $this; }
    public function originalTransactionRequestId(?string $originalTransactionRequestId): self { $this->voidRequest->setOriginalTransactionRequestId($originalTransactionRequestId); return $this; }
    public function transactionRequestId(?string $transactionRequestId): self { $this->voidRequest->setTransactionRequestId($transactionRequestId); return $this; }
    public function description(?string $description): self { $this->voidRequest->setDescription($description); return $this; }
    public function terminalSn(?string $terminalSn): self { $this->voidRequest->setTerminalSn($terminalSn); return $this; }
    public function attach(?string $attach): self { $this->voidRequest->setAttach($attach); return $this; }
    public function notifyUrl(?string $notifyUrl): self { $this->voidRequest->setNotifyUrl($notifyUrl); return $this; }
    public function printReceipt(?PrintReceiptOption $printReceipt): self { $this->voidRequest->setPrintReceipt($printReceipt); return $this; }
    public function pushToTerminal(?bool $pushToTerminal): self { $this->voidRequest->setPushToTerminal($pushToTerminal); return $this; }
    public function terminalEventNotifyUrl(?string $terminalEventNotifyUrl): self { $this->voidRequest->setTerminalEventNotifyUrl($terminalEventNotifyUrl); return $this; }

    public function build(): VoidRequest
    {
        return $this->voidRequest;
    }
}

