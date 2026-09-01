<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Request;

/**
 * Merchant query request
 *
 * @since 2026-09-01
 */
class MerchantQueryRequest
{
    public function __construct(
        ?string $appId = null,
        ?string $merchantId = null
    ) {
        if ($appId !== null) $this->setAppId($appId);
        if ($merchantId !== null) $this->setMerchantId($merchantId);
    }

    private ?string $appId = null;
    /** SUNBAY platform merchant unique identifier (11-char alphanumeric starting with M) */
    private ?string $merchantId = null;

    public function getAppId(): ?string { return $this->appId; }
    public function setAppId(?string $appId): self { $this->appId = $appId; return $this; }

    public function getMerchantId(): ?string { return $this->merchantId; }
    public function setMerchantId(?string $merchantId): self { $this->merchantId = $merchantId; return $this; }

    public static function builder(): MerchantQueryRequestBuilder
    {
        return new MerchantQueryRequestBuilder();
    }
}

class MerchantQueryRequestBuilder
{
    private MerchantQueryRequest $request;

    public function __construct()
    {
        $this->request = new MerchantQueryRequest();
    }

    public function appId(?string $appId): self { $this->request->setAppId($appId); return $this; }
    public function merchantId(?string $merchantId): self { $this->request->setMerchantId($merchantId); return $this; }

    public function build(): MerchantQueryRequest
    {
        return $this->request;
    }
}
