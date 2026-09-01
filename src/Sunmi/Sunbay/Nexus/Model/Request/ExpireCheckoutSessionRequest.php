<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Request;

/**
 * POST /v1/checkout/expire-session — expire/close a checkout session.
 *
 * @author Andy Li
 * @since 2026-08-03
 */
class ExpireCheckoutSessionRequest
{
    public function __construct(
        ?string $appId = null,
        ?string $merchantId = null,
        ?string $sessionId = null,
        ?string $reason = null
    ) {
        if ($appId !== null) $this->setAppId($appId);
        if ($merchantId !== null) $this->setMerchantId($merchantId);
        if ($sessionId !== null) $this->setSessionId($sessionId);
        if ($reason !== null) $this->setReason($reason);
    }

    private ?string $appId = null;
    private ?string $merchantId = null;
    private ?string $sessionId = null;
    private ?string $reason = null;

    public function getAppId(): ?string { return $this->appId; }
    public function setAppId(?string $appId): self { $this->appId = $appId; return $this; }

    public function getMerchantId(): ?string { return $this->merchantId; }
    public function setMerchantId(?string $merchantId): self { $this->merchantId = $merchantId; return $this; }

    public function getSessionId(): ?string { return $this->sessionId; }
    public function setSessionId(?string $sessionId): self { $this->sessionId = $sessionId; return $this; }

    public function getReason(): ?string { return $this->reason; }
    public function setReason(?string $reason): self { $this->reason = $reason; return $this; }

    public static function builder(): ExpireCheckoutSessionRequestBuilder
    {
        return new ExpireCheckoutSessionRequestBuilder();
    }
}

class ExpireCheckoutSessionRequestBuilder
{
    private ExpireCheckoutSessionRequest $request;

    public function __construct()
    {
        $this->request = new ExpireCheckoutSessionRequest();
    }

    public function appId(?string $appId): self { $this->request->setAppId($appId); return $this; }
    public function merchantId(?string $merchantId): self { $this->request->setMerchantId($merchantId); return $this; }
    public function sessionId(?string $sessionId): self { $this->request->setSessionId($sessionId); return $this; }
    public function reason(?string $reason): self { $this->request->setReason($reason); return $this; }

    public function build(): ExpireCheckoutSessionRequest
    {
        return $this->request;
    }
}
