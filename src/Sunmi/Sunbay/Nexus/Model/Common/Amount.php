<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Common;

/**
 * Amount information
 * All amount fields are in cents (e.g., 10000 = $100.00)
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class Amount
{
    private ?string $priceCurrency = null;
    private ?int $transAmount = null;
    private ?int $orderAmount = null;
    private ?int $taxAmount = null;
    private ?int $surchargeAmount = null;
    private ?int $tipAmount = null;
    private ?int $cashbackAmount = null;

    public function getPriceCurrency(): ?string
    {
        return $this->priceCurrency;
    }

    public function setPriceCurrency(?string $priceCurrency): self
    {
        $this->priceCurrency = $priceCurrency;
        return $this;
    }

    public function getTransAmount(): ?int
    {
        return $this->transAmount;
    }

    public function setTransAmount(?int $transAmount): self
    {
        $this->transAmount = $transAmount;
        return $this;
    }

    public function getOrderAmount(): ?int
    {
        return $this->orderAmount;
    }

    public function setOrderAmount(?int $orderAmount): self
    {
        $this->orderAmount = $orderAmount;
        return $this;
    }

    public function getTaxAmount(): ?int
    {
        return $this->taxAmount;
    }

    public function setTaxAmount(?int $taxAmount): self
    {
        $this->taxAmount = $taxAmount;
        return $this;
    }

    public function getSurchargeAmount(): ?int
    {
        return $this->surchargeAmount;
    }

    public function setSurchargeAmount(?int $surchargeAmount): self
    {
        $this->surchargeAmount = $surchargeAmount;
        return $this;
    }

    public function getTipAmount(): ?int
    {
        return $this->tipAmount;
    }

    public function setTipAmount(?int $tipAmount): self
    {
        $this->tipAmount = $tipAmount;
        return $this;
    }

    public function getCashbackAmount(): ?int
    {
        return $this->cashbackAmount;
    }

    public function setCashbackAmount(?int $cashbackAmount): self
    {
        $this->cashbackAmount = $cashbackAmount;
        return $this;
    }
}
