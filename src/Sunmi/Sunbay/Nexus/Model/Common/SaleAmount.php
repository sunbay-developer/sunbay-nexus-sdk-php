<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Common;

/**
 * Sale transaction amount information
 * Supports: orderAmount, tipAmount, taxAmount, surchargeAmount, cashbackAmount
 * All amount fields are in cents (e.g., 10000 = $100.00)
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class SaleAmount
{
    /**
     * Order amount in cents (required, e.g., 10000 = $100.00)
     */
    private ?int $orderAmount = null;

    /**
     * Tip amount in cents (optional, e.g., 500 = $5.00)
     */
    private ?int $tipAmount = null;

    /**
     * Tax amount in cents (optional, e.g., 800 = $8.00)
     */
    private ?int $taxAmount = null;

    /**
     * Surcharge amount in cents (optional, e.g., 200 = $2.00)
     */
    private ?int $surchargeAmount = null;

    /**
     * Cashback amount in cents (optional, e.g., 1000 = $10.00)
     */
    private ?int $cashbackAmount = null;

    /**
     * Price currency (ISO 4217, required)
     */
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

    public function getTipAmount(): ?int
    {
        return $this->tipAmount;
    }

    public function setTipAmount(?int $tipAmount): self
    {
        $this->tipAmount = $tipAmount;
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

    public function getCashbackAmount(): ?int
    {
        return $this->cashbackAmount;
    }

    public function setCashbackAmount(?int $cashbackAmount): self
    {
        $this->cashbackAmount = $cashbackAmount;
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

    public function orderAmount(?int $orderAmount): self
    {
        $this->saleAmount->setOrderAmount($orderAmount);
        return $this;
    }

    public function tipAmount(?int $tipAmount): self
    {
        $this->saleAmount->setTipAmount($tipAmount);
        return $this;
    }

    public function taxAmount(?int $taxAmount): self
    {
        $this->saleAmount->setTaxAmount($taxAmount);
        return $this;
    }

    public function surchargeAmount(?int $surchargeAmount): self
    {
        $this->saleAmount->setSurchargeAmount($surchargeAmount);
        return $this;
    }

    public function cashbackAmount(?int $cashbackAmount): self
    {
        $this->saleAmount->setCashbackAmount($cashbackAmount);
        return $this;
    }

    public function priceCurrency(?string $priceCurrency): self
    {
        $this->saleAmount->setPriceCurrency($priceCurrency);
        return $this;
    }

    public function build(): SaleAmount
    {
        return $this->saleAmount;
    }
}
