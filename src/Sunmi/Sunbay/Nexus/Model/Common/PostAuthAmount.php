<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Common;

/**
 * Post authorization amount information
 * Supports: orderAmount, tipAmount, taxAmount, surchargeAmount
 * Does NOT support: cashbackAmount
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class PostAuthAmount
{
    private ?float $orderAmount = null;
    private ?float $tipAmount = null;
    private ?float $taxAmount = null;
    private ?float $surchargeAmount = null;
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

    public function orderAmount(?float $orderAmount): self
    {
        $this->postAuthAmount->setOrderAmount($orderAmount);
        return $this;
    }

    public function tipAmount(?float $tipAmount): self
    {
        $this->postAuthAmount->setTipAmount($tipAmount);
        return $this;
    }

    public function taxAmount(?float $taxAmount): self
    {
        $this->postAuthAmount->setTaxAmount($taxAmount);
        return $this;
    }

    public function surchargeAmount(?float $surchargeAmount): self
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


