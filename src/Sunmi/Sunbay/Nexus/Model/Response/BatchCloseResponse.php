<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Response;

use Sunmi\Sunbay\Nexus\Model\Common\BaseResponse;
use Sunmi\Sunbay\Nexus\Model\Common\BatchTotalAmount;

/**
 * Batch close response
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class BatchCloseResponse extends BaseResponse
{
    private ?string $batchNo = null;
    private ?string $terminalSn = null;
    private ?string $closeTime = null;
    private ?int $transactionCount = null;
    private ?BatchTotalAmount $totalAmount = null;

    public function getBatchNo(): ?string { return $this->batchNo; }
    public function setBatchNo(?string $batchNo): self { $this->batchNo = $batchNo; return $this; }

    public function getTerminalSn(): ?string { return $this->terminalSn; }
    public function setTerminalSn(?string $terminalSn): self { $this->terminalSn = $terminalSn; return $this; }

    public function getCloseTime(): ?string { return $this->closeTime; }
    public function setCloseTime(?string $closeTime): self { $this->closeTime = $closeTime; return $this; }

    public function getTransactionCount(): ?int { return $this->transactionCount; }
    public function setTransactionCount(?int $transactionCount): self { $this->transactionCount = $transactionCount; return $this; }

    public function getTotalAmount(): ?BatchTotalAmount { return $this->totalAmount; }
    public function setTotalAmount(?BatchTotalAmount $totalAmount): self { $this->totalAmount = $totalAmount; return $this; }
}

