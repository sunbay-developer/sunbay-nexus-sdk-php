<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Common;

/**
 * Amount information
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class Amount
{
    private ?string $priceCurrency = null;
    private ?float $transAmount = null;
    private ?float $orderAmount = null;
    private ?float $taxAmount = null;
    private ?float $surchargeAmount = null;
    private ?float $tipAmount = null;
    private ?float $cashbackAmount = null;
    private ?string $pricingCurrency = null;

    public function getPriceCurrency(): ?string
    {
        return $this->priceCurrency;
    }

    public function setPriceCurrency(?string $priceCurrency): self
    {
        $this->priceCurrency = $priceCurrency;
        return $this;
    }

    public function getTransAmount(): ?float
    {
        return $this->transAmount;
    }

    public function setTransAmount(?float $transAmount): self
    {
        $this->transAmount = $transAmount;
        return $this;
    }

    public function getOrderAmount(): ?float
    {
        return $this->orderAmount;
    }

    public function setOrderAmount(?float $orderAmount): self
    {
        $this->orderAmount = $orderAmount;
        return $this;
    }

    public function getTaxAmount(): ?float
    {
        return $this->taxAmount;
    }

    public function setTaxAmount(?float $taxAmount): self
    {
        $this->taxAmount = $taxAmount;
        return $this;
    }

    public function getSurchargeAmount(): ?float
    {
        return $this->surchargeAmount;
    }

    public function setSurchargeAmount(?float $surchargeAmount): self
    {
        $this->surchargeAmount = $surchargeAmount;
        return $this;
    }

    public function getTipAmount(): ?float
    {
        return $this->tipAmount;
    }

    public function setTipAmount(?float $tipAmount): self
    {
        $this->tipAmount = $tipAmount;
        return $this;
    }

    public function getCashbackAmount(): ?float
    {
        return $this->cashbackAmount;
    }

    public function setCashbackAmount(?float $cashbackAmount): self
    {
        $this->cashbackAmount = $cashbackAmount;
        return $this;
    }

    public function getPricingCurrency(): ?string
    {
        return $this->pricingCurrency;
    }

    public function setPricingCurrency(?string $pricingCurrency): self
    {
        $this->pricingCurrency = $pricingCurrency;
        return $this;
    }
}
