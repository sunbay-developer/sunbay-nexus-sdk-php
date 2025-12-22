<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Common;

/**
 * Sale transaction amount information
 * Supports: orderAmount, tipAmount, taxAmount, surchargeAmount, cashbackAmount
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class SaleAmount
{
    /**
     * Order amount (required)
     */
    private ?float $orderAmount = null;

    /**
     * Tip amount (optional)
     */
    private ?float $tipAmount = null;

    /**
     * Tax amount (optional)
     */
    private ?float $taxAmount = null;

    /**
     * Surcharge amount (optional)
     */
    private ?float $surchargeAmount = null;

    /**
     * Cashback amount (optional)
     */
    private ?float $cashbackAmount = null;

    /**
     * Pricing currency (ISO 4217, required)
     */
    private ?string $pricingCurrency = null;

    public function getOrderAmount(): ?float
    {
        return $this->orderAmount;
    }

    public function setOrderAmount(?float $orderAmount): self
    {
        $this->orderAmount = $orderAmount;
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

    /**
     * Create builder instance
     *
     * @return SaleAmountBuilder
     */
    public static function builder(): SaleAmountBuilder
    {
        return new SaleAmountBuilder();
    }
}

/**
 * Builder for SaleAmount
 */
class SaleAmountBuilder
{
    private SaleAmount $saleAmount;

    public function __construct()
    {
        $this->saleAmount = new SaleAmount();
    }

    public function orderAmount(?float $orderAmount): self
    {
        $this->saleAmount->setOrderAmount($orderAmount);
        return $this;
    }

    public function tipAmount(?float $tipAmount): self
    {
        $this->saleAmount->setTipAmount($tipAmount);
        return $this;
    }

    public function taxAmount(?float $taxAmount): self
    {
        $this->saleAmount->setTaxAmount($taxAmount);
        return $this;
    }

    public function surchargeAmount(?float $surchargeAmount): self
    {
        $this->saleAmount->setSurchargeAmount($surchargeAmount);
        return $this;
    }

    public function cashbackAmount(?float $cashbackAmount): self
    {
        $this->saleAmount->setCashbackAmount($cashbackAmount);
        return $this;
    }

    public function pricingCurrency(?string $pricingCurrency): self
    {
        $this->saleAmount->setPricingCurrency($pricingCurrency);
        return $this;
    }

    public function build(): SaleAmount
    {
        return $this->saleAmount;
    }
}
