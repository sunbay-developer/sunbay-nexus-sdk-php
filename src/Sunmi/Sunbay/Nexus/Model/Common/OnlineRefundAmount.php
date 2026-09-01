<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Common;

/**
 * Online refund amount information (smallest currency unit).
 *
 * @author Andy Li
 * @since 2026-06-29
 */
class OnlineRefundAmount
{
    public function __construct(
        ?string $priceCurrency = null,
        ?int $totalAmount = null,
        ?int $orderAmount = null,
        ?int $taxAmount = null,
        ?int $surchargeAmount = null,
        ?int $tipAmount = null
    ) {
        if ($priceCurrency !== null) $this->setPriceCurrency($priceCurrency);
        if ($totalAmount !== null) $this->setTotalAmount($totalAmount);
        if ($orderAmount !== null) $this->setOrderAmount($orderAmount);
        if ($taxAmount !== null) $this->setTaxAmount($taxAmount);
        if ($surchargeAmount !== null) $this->setSurchargeAmount($surchargeAmount);
        if ($tipAmount !== null) $this->setTipAmount($tipAmount);
    }

    private ?string $priceCurrency = null;
    private ?int $totalAmount = null;
    private ?int $orderAmount = null;
    private ?int $taxAmount = null;
    private ?int $surchargeAmount = null;
    private ?int $tipAmount = null;

    public function getPriceCurrency(): ?string { return $this->priceCurrency; }
    public function setPriceCurrency(?string $priceCurrency): self { $this->priceCurrency = $priceCurrency; return $this; }

    public function getTotalAmount(): ?int { return $this->totalAmount; }
    public function setTotalAmount(?int $totalAmount): self { $this->totalAmount = $totalAmount; return $this; }

    public function getOrderAmount(): ?int { return $this->orderAmount; }
    public function setOrderAmount(?int $orderAmount): self { $this->orderAmount = $orderAmount; return $this; }

    public function getTaxAmount(): ?int { return $this->taxAmount; }
    public function setTaxAmount(?int $taxAmount): self { $this->taxAmount = $taxAmount; return $this; }

    public function getSurchargeAmount(): ?int { return $this->surchargeAmount; }
    public function setSurchargeAmount(?int $surchargeAmount): self { $this->surchargeAmount = $surchargeAmount; return $this; }

    public function getTipAmount(): ?int { return $this->tipAmount; }
    public function setTipAmount(?int $tipAmount): self { $this->tipAmount = $tipAmount; return $this; }

    public static function builder(): OnlineRefundAmountBuilder
    {
        return new OnlineRefundAmountBuilder();
    }
}

class OnlineRefundAmountBuilder
{
    private OnlineRefundAmount $amount;

    public function __construct()
    {
        $this->amount = new OnlineRefundAmount();
    }

    public function priceCurrency(?string $priceCurrency): self { $this->amount->setPriceCurrency($priceCurrency); return $this; }
    public function totalAmount(?int $totalAmount): self { $this->amount->setTotalAmount($totalAmount); return $this; }
    public function orderAmount(?int $orderAmount): self { $this->amount->setOrderAmount($orderAmount); return $this; }
    public function taxAmount(?int $taxAmount): self { $this->amount->setTaxAmount($taxAmount); return $this; }
    public function surchargeAmount(?int $surchargeAmount): self { $this->amount->setSurchargeAmount($surchargeAmount); return $this; }
    public function tipAmount(?int $tipAmount): self { $this->amount->setTipAmount($tipAmount); return $this; }

    public function build(): OnlineRefundAmount
    {
        return $this->amount;
    }
}
