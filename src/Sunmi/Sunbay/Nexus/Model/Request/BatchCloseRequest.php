<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Request;

/**
 * Batch close request
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class BatchCloseRequest
{
    private ?string $appId = null;
    private ?string $merchantId = null;
    private ?string $transactionRequestId = null;
    private ?string $terminalSn = null;
    private ?string $description = null;
    private ?string $attach = null;

    // Getters and setters
    public function getAppId(): ?string { return $this->appId; }
    public function setAppId(?string $appId): self { $this->appId = $appId; return $this; }

    public function getMerchantId(): ?string { return $this->merchantId; }
    public function setMerchantId(?string $merchantId): self { $this->merchantId = $merchantId; return $this; }

    public function getTransactionRequestId(): ?string { return $this->transactionRequestId; }
    public function setTransactionRequestId(?string $transactionRequestId): self { $this->transactionRequestId = $transactionRequestId; return $this; }

    public function getTerminalSn(): ?string { return $this->terminalSn; }
    public function setTerminalSn(?string $terminalSn): self { $this->terminalSn = $terminalSn; return $this; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): self { $this->description = $description; return $this; }

    public function getAttach(): ?string { return $this->attach; }
    public function setAttach(?string $attach): self { $this->attach = $attach; return $this; }

    public static function builder(): BatchCloseRequestBuilder
    {
        return new BatchCloseRequestBuilder();
    }
}

class BatchCloseRequestBuilder
{
    private BatchCloseRequest $batchCloseRequest;

    public function __construct()
    {
        $this->batchCloseRequest = new BatchCloseRequest();
    }

    public function appId(?string $appId): self { $this->batchCloseRequest->setAppId($appId); return $this; }
    public function merchantId(?string $merchantId): self { $this->batchCloseRequest->setMerchantId($merchantId); return $this; }
    public function transactionRequestId(?string $transactionRequestId): self { $this->batchCloseRequest->setTransactionRequestId($transactionRequestId); return $this; }
    public function terminalSn(?string $terminalSn): self { $this->batchCloseRequest->setTerminalSn($terminalSn); return $this; }
    public function description(?string $description): self { $this->batchCloseRequest->setDescription($description); return $this; }
    public function attach(?string $attach): self { $this->batchCloseRequest->setAttach($attach); return $this; }

    public function build(): BatchCloseRequest
    {
        return $this->batchCloseRequest;
    }
}

