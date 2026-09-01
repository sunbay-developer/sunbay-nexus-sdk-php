<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Common;

/**
 * Batch close list item information
 *
 * Represents a single closed (settled) batch record.
 *
 * @since 2026-09-01
 */
class BatchCloseListItem
{
    public function __construct(
        ?string $batchNo = null,
        ?string $batchStatus = null,
        ?string $batchTime = null,
        ?int $totalCount = null,
        ?int $netAmount = null,
        ?string $priceCurrency = null,
        ?string $channelCode = null,
        ?string $terminalSn = null,
        ?string $mid = null,
        ?string $tid = null
    ) {
        if ($batchNo !== null) $this->setBatchNo($batchNo);
        if ($batchStatus !== null) $this->setBatchStatus($batchStatus);
        if ($batchTime !== null) $this->setBatchTime($batchTime);
        if ($totalCount !== null) $this->setTotalCount($totalCount);
        if ($netAmount !== null) $this->setNetAmount($netAmount);
        if ($priceCurrency !== null) $this->setPriceCurrency($priceCurrency);
        if ($channelCode !== null) $this->setChannelCode($channelCode);
        if ($terminalSn !== null) $this->setTerminalSn($terminalSn);
        if ($mid !== null) $this->setMid($mid);
        if ($tid !== null) $this->setTid($tid);
    }

    /** Batch number */
    private ?string $batchNo = null;
    /** Batch status: S - Success */
    private ?string $batchStatus = null;
    /** Batch close time, ISO 8601 format */
    private ?string $batchTime = null;
    /** Total number of transactions in the batch */
    private ?int $totalCount = null;
    /** Total net amount, using minor units (ISO 4217 decimal places) */
    private ?int $netAmount = null;
    /** Transaction currency (ISO 4217, e.g. USD, CNY) */
    private ?string $priceCurrency = null;
    /** Payment channel code */
    private ?string $channelCode = null;
    /** Terminal serial number */
    private ?string $terminalSn = null;
    /** Merchant Identification number (MID) assigned by the payment processor */
    private ?string $mid = null;
    /** Terminal Identification number (TID) assigned by the payment processor */
    private ?string $tid = null;

    public function getBatchNo(): ?string { return $this->batchNo; }
    public function setBatchNo(?string $batchNo): self { $this->batchNo = $batchNo; return $this; }

    public function getBatchStatus(): ?string { return $this->batchStatus; }
    public function setBatchStatus(?string $batchStatus): self { $this->batchStatus = $batchStatus; return $this; }

    public function getBatchTime(): ?string { return $this->batchTime; }
    public function setBatchTime(?string $batchTime): self { $this->batchTime = $batchTime; return $this; }

    public function getTotalCount(): ?int { return $this->totalCount; }
    public function setTotalCount(?int $totalCount): self { $this->totalCount = $totalCount; return $this; }

    public function getNetAmount(): ?int { return $this->netAmount; }
    public function setNetAmount(?int $netAmount): self { $this->netAmount = $netAmount; return $this; }

    public function getPriceCurrency(): ?string { return $this->priceCurrency; }
    public function setPriceCurrency(?string $priceCurrency): self { $this->priceCurrency = $priceCurrency; return $this; }

    public function getChannelCode(): ?string { return $this->channelCode; }
    public function setChannelCode(?string $channelCode): self { $this->channelCode = $channelCode; return $this; }

    public function getTerminalSn(): ?string { return $this->terminalSn; }
    public function setTerminalSn(?string $terminalSn): self { $this->terminalSn = $terminalSn; return $this; }

    public function getMid(): ?string { return $this->mid; }
    public function setMid(?string $mid): self { $this->mid = $mid; return $this; }

    public function getTid(): ?string { return $this->tid; }
    public function setTid(?string $tid): self { $this->tid = $tid; return $this; }
}
