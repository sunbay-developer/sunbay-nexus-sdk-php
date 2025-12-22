<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Common;

/**
 * Batch total amount information
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class BatchTotalAmount
{
    private ?string $priceCurrency = null;
    private ?float $amount = null;

    public function getPriceCurrency(): ?string
    {
        return $this->priceCurrency;
    }

    public function setPriceCurrency(?string $priceCurrency): self
    {
        $this->priceCurrency = $priceCurrency;
        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(?float $amount): self
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

    public function amount(?float $amount): self
    {
        $this->batchTotalAmount->setAmount($amount);
        return $this;
    }

    public function build(): BatchTotalAmount
    {
        return $this->batchTotalAmount;
    }
}
