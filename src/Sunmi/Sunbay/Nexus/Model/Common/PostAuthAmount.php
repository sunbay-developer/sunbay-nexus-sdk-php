<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Common;

/**
 * Post authorization amount information
 * Supports: orderAmount, tipAmount, taxAmount, surchargeAmount
 * Does NOT support: cashbackAmount
 * All amount fields are in cents (e.g., 10000 = $100.00)
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class PostAuthAmount
{
    private ?int $orderAmount = null;
    private ?int $tipAmount = null;
    private ?int $taxAmount = null;
    private ?int $surchargeAmount = null;
    private ?string $pricingCurrency = null;

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

    public function getPricingCurrency(): ?string
    {
        return $this->pricingCurrency;
    }

    public function setPricingCurrency(?string $pricingCurrency): self
    {
        $this->pricingCurrency = $pricingCurrency;
        return $this;
    }

    public static function builder(): PostAuthAmountBuilder
    {
        return new PostAuthAmountBuilder();
    }
}

class PostAuthAmountBuilder
{
    private PostAuthAmount $postAuthAmount;

    public function __construct()
    {
        $this->postAuthAmount = new PostAuthAmount();
    }

    public function orderAmount(?int $orderAmount): self
    {
        $this->postAuthAmount->setOrderAmount($orderAmount);
        return $this;
    }

    public function tipAmount(?int $tipAmount): self
    {
        $this->postAuthAmount->setTipAmount($tipAmount);
        return $this;
    }

    public function taxAmount(?int $taxAmount): self
    {
        $this->postAuthAmount->setTaxAmount($taxAmount);
        return $this;
    }

    public function surchargeAmount(?int $surchargeAmount): self
    {
        $this->postAuthAmount->setSurchargeAmount($surchargeAmount);
        return $this;
    }

    public function pricingCurrency(?string $pricingCurrency): self
    {
        $this->postAuthAmount->setPricingCurrency($pricingCurrency);
        return $this;
    }

    public function build(): PostAuthAmount
    {
        return $this->postAuthAmount;
    }
}
