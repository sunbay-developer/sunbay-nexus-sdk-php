<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Request;

/**
 * Batch query request
 *
 * @author Andy Li
 * @since 2025-12-26
 */
class BatchQueryRequest
{
    private ?string $appId = null;
    private ?string $merchantId = null;
    private ?string $terminalSn = null;

    // Getters and setters
    public function getAppId(): ?string { return $this->appId; }
    public function setAppId(?string $appId): self { $this->appId = $appId; return $this; }

    public function getMerchantId(): ?string { return $this->merchantId; }
    public function setMerchantId(?string $merchantId): self { $this->merchantId = $merchantId; return $this; }

    public function getTerminalSn(): ?string { return $this->terminalSn; }
    public function setTerminalSn(?string $terminalSn): self { $this->terminalSn = $terminalSn; return $this; }

    public static function builder(): BatchQueryRequestBuilder
    {
        return new BatchQueryRequestBuilder();
    }
}

class BatchQueryRequestBuilder
{
    private BatchQueryRequest $batchQueryRequest;

    public function __construct()
    {
        $this->batchQueryRequest = new BatchQueryRequest();
    }

    public function appId(?string $appId): self { $this->batchQueryRequest->setAppId($appId); return $this; }
    public function merchantId(?string $merchantId): self { $this->batchQueryRequest->setMerchantId($merchantId); return $this; }
    public function terminalSn(?string $terminalSn): self { $this->batchQueryRequest->setTerminalSn($terminalSn); return $this; }

    public function build(): BatchQueryRequest
    {
        return $this->batchQueryRequest;
    }
}

