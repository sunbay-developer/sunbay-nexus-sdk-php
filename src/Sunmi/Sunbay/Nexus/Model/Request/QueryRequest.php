<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Request;

/**
 * Query request
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class QueryRequest
{
    private ?string $appId = null;
    private ?string $merchantId = null;
    private ?string $transactionId = null;
    private ?string $transactionRequestId = null;

    public function getAppId(): ?string { return $this->appId; }
    public function setAppId(?string $appId): self { $this->appId = $appId; return $this; }

    public function getMerchantId(): ?string { return $this->merchantId; }
    public function setMerchantId(?string $merchantId): self { $this->merchantId = $merchantId; return $this; }

    public function getTransactionId(): ?string { return $this->transactionId; }
    public function setTransactionId(?string $transactionId): self { $this->transactionId = $transactionId; return $this; }

    public function getTransactionRequestId(): ?string { return $this->transactionRequestId; }
    public function setTransactionRequestId(?string $transactionRequestId): self { $this->transactionRequestId = $transactionRequestId; return $this; }

    public static function builder(): QueryRequestBuilder
    {
        return new QueryRequestBuilder();
    }
}

class QueryRequestBuilder
{
    private QueryRequest $queryRequest;

    public function __construct()
    {
        $this->queryRequest = new QueryRequest();
    }

    public function appId(?string $appId): self { $this->queryRequest->setAppId($appId); return $this; }
    public function merchantId(?string $merchantId): self { $this->queryRequest->setMerchantId($merchantId); return $this; }
    public function transactionId(?string $transactionId): self { $this->queryRequest->setTransactionId($transactionId); return $this; }
    public function transactionRequestId(?string $transactionRequestId): self { $this->queryRequest->setTransactionRequestId($transactionRequestId); return $this; }

    public function build(): QueryRequest
    {
        return $this->queryRequest;
    }
}

