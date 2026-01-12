<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Common;

/**
 * Authorization amount information
 * Supports: orderAmount, priceCurrency only
 * Used for: Auth, ForcedAuth, IncrementalAuth
 * Amount is in cents (e.g., 10000 = $100.00)
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class AuthAmount
{
    private ?int $orderAmount = null;
    private ?string $priceCurrency = null;

    public function getOrderAmount(): ?int
    {
        return $this->orderAmount;
    }

    public function setOrderAmount(?int $orderAmount): self
    {
        $this->orderAmount = $orderAmount;
        return $this;
    }

    public function getPriceCurrency(): ?string
    {
        return $this->priceCurrency;
    }

    public function setPriceCurrency(?string $priceCurrency): self
    {
        $this->priceCurrency = $priceCurrency;
        return $this;
    }

    public static function builder(): AuthAmountBuilder
    {
        return new AuthAmountBuilder();
    }
}

class AuthAmountBuilder
{
    private AuthAmount $authAmount;

    public function __construct()
    {
        $this->authAmount = new AuthAmount();
    }

    public function orderAmount(?int $orderAmount): self
    {
        $this->authAmount->setOrderAmount($orderAmount);
        return $this;
    }

    public function priceCurrency(?string $priceCurrency): self
    {
        $this->authAmount->setPriceCurrency($priceCurrency);
        return $this;
    }

    public function build(): AuthAmount
    {
        return $this->authAmount;
    }
}
