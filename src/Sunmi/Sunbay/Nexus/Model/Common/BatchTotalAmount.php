<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Common;

/**
 * Batch total amount information
 * Amount is in cents (e.g., 10000 = $100.00)
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class BatchTotalAmount
{
    private ?string $priceCurrency = null;
    private ?int $amount = null;

    public function getPriceCurrency(): ?string
    {
        return $this->priceCurrency;
    }

    public function setPriceCurrency(?string $priceCurrency): self
    {
        $this->priceCurrency = $priceCurrency;
        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(?int $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    public static function builder(): BatchTotalAmountBuilder
    {
        return new BatchTotalAmountBuilder();
    }
}

class BatchTotalAmountBuilder
{
    private BatchTotalAmount $batchTotalAmount;

    public function __construct()
    {
        $this->batchTotalAmount = new BatchTotalAmount();
    }

    public function priceCurrency(?string $priceCurrency): self
    {
        $this->batchTotalAmount->setPriceCurrency($priceCurrency);
        return $this;
    }

    public function amount(?int $amount): self
    {
        $this->batchTotalAmount->setAmount($amount);
        return $this;
    }

    public function build(): BatchTotalAmount
    {
        return $this->batchTotalAmount;
    }
}
