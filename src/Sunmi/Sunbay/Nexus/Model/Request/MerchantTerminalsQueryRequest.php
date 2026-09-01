<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Request;

/**
 * Merchant terminals query request
 *
 * @since 2026-09-01
 */
class MerchantTerminalsQueryRequest
{
    public function __construct(
        ?string $appId = null,
        ?string $merchantId = null,
        ?string $nextToken = null
    ) {
        if ($appId !== null) $this->setAppId($appId);
        if ($merchantId !== null) $this->setMerchantId($merchantId);
        if ($nextToken !== null) $this->setNextToken($nextToken);
    }

    private ?string $appId = null;
    /** SUNBAY platform merchant unique identifier (11-char alphanumeric starting with M) */
    private ?string $merchantId = null;
    /** Pagination token returned by the previous response. Omit on the first request */
    private ?string $nextToken = null;

    public function getAppId(): ?string { return $this->appId; }
    public function setAppId(?string $appId): self { $this->appId = $appId; return $this; }

    public function getMerchantId(): ?string { return $this->merchantId; }
    public function setMerchantId(?string $merchantId): self { $this->merchantId = $merchantId; return $this; }

    public function getNextToken(): ?string { return $this->nextToken; }
    public function setNextToken(?string $nextToken): self { $this->nextToken = $nextToken; return $this; }

    public static function builder(): MerchantTerminalsQueryRequestBuilder
    {
        return new MerchantTerminalsQueryRequestBuilder();
    }
}

class MerchantTerminalsQueryRequestBuilder
{
    private MerchantTerminalsQueryRequest $request;

    public function __construct()
    {
        $this->request = new MerchantTerminalsQueryRequest();
    }

    public function appId(?string $appId): self { $this->request->setAppId($appId); return $this; }
    public function merchantId(?string $merchantId): self { $this->request->setMerchantId($merchantId); return $this; }
    public function nextToken(?string $nextToken): self { $this->request->setNextToken($nextToken); return $this; }

    public function build(): MerchantTerminalsQueryRequest
    {
        return $this->request;
    }
}
