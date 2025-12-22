<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Common;

/**
 * Refund amount information
 * Supports: orderAmount, tipAmount, taxAmount, surchargeAmount, cashbackAmount
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class RefundAmount
{
    private ?float $orderAmount = null;
    private ?float $tipAmount = null;
    private ?float $taxAmount = null;
    private ?float $surchargeAmount = null;
    private ?float $cashbackAmount = null;
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

    public static function builder(): RefundAmountBuilder
    {
        return new RefundAmountBuilder();
    }
}

class RefundAmountBuilder
{
    private RefundAmount $refundAmount;

    public function __construct()
    {
        $this->refundAmount = new RefundAmount();
    }

    public function orderAmount(?float $orderAmount): self
    {
        $this->refundAmount->setOrderAmount($orderAmount);
        return $this;
    }

    public function tipAmount(?float $tipAmount): self
    {
        $this->refundAmount->setTipAmount($tipAmount);
        return $this;
    }

    public function taxAmount(?float $taxAmount): self
    {
        $this->refundAmount->setTaxAmount($taxAmount);
        return $this;
    }

    public function surchargeAmount(?float $surchargeAmount): self
    {
        $this->refundAmount->setSurchargeAmount($surchargeAmount);
        return $this;
    }

    public function cashbackAmount(?float $cashbackAmount): self
    {
        $this->refundAmount->setCashbackAmount($cashbackAmount);
        return $this;
    }

    public function pricingCurrency(?string $pricingCurrency): self
    {
        $this->refundAmount->setPricingCurrency($pricingCurrency);
        return $this;
    }

    public function build(): RefundAmount
    {
        return $this->refundAmount;
    }
}
