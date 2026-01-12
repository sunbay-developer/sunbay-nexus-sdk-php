<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Common;

/**
 * Batch query item information
 * <p>
 * Statistics grouped by channel code and price currency
 * </p>
 *
 * @author Andy Li
 * @since 2025-12-26
 */
class BatchQueryItem
{
    private ?string $batchNo = null;
    private ?string $startTime = null;
    private ?string $channelCode = null;
    private ?string $priceCurrency = null;
    private ?int $totalCount = null;
    private ?int $netAmount = null;
    private ?int $tipAmount = null;
    private ?int $surchargeAmount = null;
    private ?int $taxAmount = null;

    public function getBatchNo(): ?string { return $this->batchNo; }
    public function setBatchNo(?string $batchNo): self { $this->batchNo = $batchNo; return $this; }

    public function getStartTime(): ?string { return $this->startTime; }
    public function setStartTime(?string $startTime): self { $this->startTime = $startTime; return $this; }

    public function getChannelCode(): ?string { return $this->channelCode; }
    public function setChannelCode(?string $channelCode): self { $this->channelCode = $channelCode; return $this; }

    public function getPriceCurrency(): ?string { return $this->priceCurrency; }
    public function setPriceCurrency(?string $priceCurrency): self { $this->priceCurrency = $priceCurrency; return $this; }

    public function getTotalCount(): ?int { return $this->totalCount; }
    public function setTotalCount(?int $totalCount): self { $this->totalCount = $totalCount; return $this; }

    public function getNetAmount(): ?int { return $this->netAmount; }
    public function setNetAmount(?int $netAmount): self { $this->netAmount = $netAmount; return $this; }

    public function getTipAmount(): ?int { return $this->tipAmount; }
    public function setTipAmount(?int $tipAmount): self { $this->tipAmount = $tipAmount; return $this; }

    public function getSurchargeAmount(): ?int { return $this->surchargeAmount; }
    public function setSurchargeAmount(?int $surchargeAmount): self { $this->surchargeAmount = $surchargeAmount; return $this; }

    public function getTaxAmount(): ?int { return $this->taxAmount; }
    public function setTaxAmount(?int $taxAmount): self { $this->taxAmount = $taxAmount; return $this; }
}

