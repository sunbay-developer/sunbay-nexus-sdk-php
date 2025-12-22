<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Request;

/**
 * Abort request
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class AbortRequest
{
    private ?string $appId = null;
    private ?string $merchantId = null;
    private ?string $originalTransactionId = null;
    private ?string $originalTransactionRequestId = null;
    private ?string $terminalSn = null;
    private ?string $description = null;
    private ?string $attach = null;

    // Getters and setters
    public function getAppId(): ?string { return $this->appId; }
    public function setAppId(?string $appId): self { $this->appId = $appId; return $this; }

    public function getMerchantId(): ?string { return $this->merchantId; }
    public function setMerchantId(?string $merchantId): self { $this->merchantId = $merchantId; return $this; }

    public function getOriginalTransactionId(): ?string { return $this->originalTransactionId; }
    public function setOriginalTransactionId(?string $originalTransactionId): self { $this->originalTransactionId = $originalTransactionId; return $this; }

    public function getOriginalTransactionRequestId(): ?string { return $this->originalTransactionRequestId; }
    public function setOriginalTransactionRequestId(?string $originalTransactionRequestId): self { $this->originalTransactionRequestId = $originalTransactionRequestId; return $this; }

    public function getTerminalSn(): ?string { return $this->terminalSn; }
    public function setTerminalSn(?string $terminalSn): self { $this->terminalSn = $terminalSn; return $this; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): self { $this->description = $description; return $this; }

    public function getAttach(): ?string { return $this->attach; }
    public function setAttach(?string $attach): self { $this->attach = $attach; return $this; }

    public static function builder(): AbortRequestBuilder
    {
        return new AbortRequestBuilder();
    }
}

class AbortRequestBuilder
{
    private AbortRequest $abortRequest;

    public function __construct()
    {
        $this->abortRequest = new AbortRequest();
    }

    public function appId(?string $appId): self { $this->abortRequest->setAppId($appId); return $this; }
    public function merchantId(?string $merchantId): self { $this->abortRequest->setMerchantId($merchantId); return $this; }
    public function originalTransactionId(?string $originalTransactionId): self { $this->abortRequest->setOriginalTransactionId($originalTransactionId); return $this; }
    public function originalTransactionRequestId(?string $originalTransactionRequestId): self { $this->abortRequest->setOriginalTransactionRequestId($originalTransactionRequestId); return $this; }
    public function terminalSn(?string $terminalSn): self { $this->abortRequest->setTerminalSn($terminalSn); return $this; }
    public function description(?string $description): self { $this->abortRequest->setDescription($description); return $this; }
    public function attach(?string $attach): self { $this->abortRequest->setAttach($attach); return $this; }

    public function build(): AbortRequest
    {
        return $this->abortRequest;
    }
}

