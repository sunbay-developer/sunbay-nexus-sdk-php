<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Common;

/**
 * Refund amount information
 * Supports: orderAmount, tipAmount, taxAmount, surchargeAmount, cashbackAmount
 * All amount fields are in cents (e.g., 10000 = $100.00)
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class RefundAmount
{
    private ?int $orderAmount = null;
    private ?int $tipAmount = null;
    private ?int $taxAmount = null;
    private ?int $surchargeAmount = null;
    private ?int $cashbackAmount = null;
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

    public function orderAmount(?int $orderAmount): self
    {
        $this->refundAmount->setOrderAmount($orderAmount);
        return $this;
    }

    public function tipAmount(?int $tipAmount): self
    {
        $this->refundAmount->setTipAmount($tipAmount);
        return $this;
    }

    public function taxAmount(?int $taxAmount): self
    {
        $this->refundAmount->setTaxAmount($taxAmount);
        return $this;
    }

    public function surchargeAmount(?int $surchargeAmount): self
    {
        $this->refundAmount->setSurchargeAmount($surchargeAmount);
        return $this;
    }

    public function cashbackAmount(?int $cashbackAmount): self
    {
        $this->refundAmount->setCashbackAmount($cashbackAmount);
        return $this;
    }

    public function priceCurrency(?string $priceCurrency): self
    {
        $this->refundAmount->setPriceCurrency($priceCurrency);
        return $this;
    }

    public function build(): RefundAmount
    {
        return $this->refundAmount;
    }
}
