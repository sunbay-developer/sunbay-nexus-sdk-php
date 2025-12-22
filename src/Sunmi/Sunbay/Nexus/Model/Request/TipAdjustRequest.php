<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Request;

/**
 * Tip adjust request
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class TipAdjustRequest
{
    private ?string $appId = null;
    private ?string $merchantId = null;
    private ?string $terminalSn = null;
    private ?string $originalTransactionId = null;
    private ?string $originalTransactionRequestId = null;
    private ?float $tipAmount = null;
    private ?string $attach = null;

    // Getters and setters
    public function getAppId(): ?string { return $this->appId; }
    public function setAppId(?string $appId): self { $this->appId = $appId; return $this; }

    public function getMerchantId(): ?string { return $this->merchantId; }
    public function setMerchantId(?string $merchantId): self { $this->merchantId = $merchantId; return $this; }

    public function getTerminalSn(): ?string { return $this->terminalSn; }
    public function setTerminalSn(?string $terminalSn): self { $this->terminalSn = $terminalSn; return $this; }

    public function getOriginalTransactionId(): ?string { return $this->originalTransactionId; }
    public function setOriginalTransactionId(?string $originalTransactionId): self { $this->originalTransactionId = $originalTransactionId; return $this; }

    public function getOriginalTransactionRequestId(): ?string { return $this->originalTransactionRequestId; }
    public function setOriginalTransactionRequestId(?string $originalTransactionRequestId): self { $this->originalTransactionRequestId = $originalTransactionRequestId; return $this; }

    public function getTipAmount(): ?float { return $this->tipAmount; }
    public function setTipAmount(?float $tipAmount): self { $this->tipAmount = $tipAmount; return $this; }

    public function getAttach(): ?string { return $this->attach; }
    public function setAttach(?string $attach): self { $this->attach = $attach; return $this; }

    public static function builder(): TipAdjustRequestBuilder
    {
        return new TipAdjustRequestBuilder();
    }
}

class TipAdjustRequestBuilder
{
    private TipAdjustRequest $tipAdjustRequest;

    public function __construct()
    {
        $this->tipAdjustRequest = new TipAdjustRequest();
    }

    public function appId(?string $appId): self { $this->tipAdjustRequest->setAppId($appId); return $this; }
    public function merchantId(?string $merchantId): self { $this->tipAdjustRequest->setMerchantId($merchantId); return $this; }
    public function terminalSn(?string $terminalSn): self { $this->tipAdjustRequest->setTerminalSn($terminalSn); return $this; }
    public function originalTransactionId(?string $originalTransactionId): self { $this->tipAdjustRequest->setOriginalTransactionId($originalTransactionId); return $this; }
    public function originalTransactionRequestId(?string $originalTransactionRequestId): self { $this->tipAdjustRequest->setOriginalTransactionRequestId($originalTransactionRequestId); return $this; }
    public function tipAmount(?float $tipAmount): self { $this->tipAdjustRequest->setTipAmount($tipAmount); return $this; }
    public function attach(?string $attach): self { $this->tipAdjustRequest->setAttach($attach); return $this; }

    public function build(): TipAdjustRequest
    {
        return $this->tipAdjustRequest;
    }
}

