<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Request;

use Sunmi\Sunbay\Nexus\Enum\BatchPrintReceiptOption;

/**
 * Batch close request
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class BatchCloseRequest
{
    public function __construct(
        ?string $appId = null,
        ?string $merchantId = null,
        ?string $transactionRequestId = null,
        ?string $terminalSn = null,
        ?string $channelCode = null,
        ?string $description = null,
        ?BatchPrintReceiptOption $printReceipt = null
    ) {
        if ($appId !== null) $this->setAppId($appId);
        if ($merchantId !== null) $this->setMerchantId($merchantId);
        if ($transactionRequestId !== null) $this->setTransactionRequestId($transactionRequestId);
        if ($terminalSn !== null) $this->setTerminalSn($terminalSn);
        if ($channelCode !== null) $this->setChannelCode($channelCode);
        if ($description !== null) $this->setDescription($description);
        if ($printReceipt !== null) $this->setPrintReceipt($printReceipt);
    }

    private ?string $appId = null;
    private ?string $merchantId = null;
    private ?string $transactionRequestId = null;
    private ?string $terminalSn = null;
    private ?string $channelCode = null;
    private ?string $description = null;
    /** Batch report print option. TOTAL/DETAIL/BOTH/NONE/AUTO. Default: use platform config */
    private ?BatchPrintReceiptOption $printReceipt = null;

    // Getters and setters
    public function getAppId(): ?string { return $this->appId; }
    public function setAppId(?string $appId): self { $this->appId = $appId; return $this; }

    public function getMerchantId(): ?string { return $this->merchantId; }
    public function setMerchantId(?string $merchantId): self { $this->merchantId = $merchantId; return $this; }

    public function getTransactionRequestId(): ?string { return $this->transactionRequestId; }
    public function setTransactionRequestId(?string $transactionRequestId): self { $this->transactionRequestId = $transactionRequestId; return $this; }

    public function getTerminalSn(): ?string { return $this->terminalSn; }
    public function setTerminalSn(?string $terminalSn): self { $this->terminalSn = $terminalSn; return $this; }

    public function getChannelCode(): ?string { return $this->channelCode; }
    public function setChannelCode(?string $channelCode): self { $this->channelCode = $channelCode; return $this; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): self { $this->description = $description; return $this; }

    public function getPrintReceipt(): ?BatchPrintReceiptOption { return $this->printReceipt; }
    public function setPrintReceipt(?BatchPrintReceiptOption $printReceipt): self { $this->printReceipt = $printReceipt; return $this; }

    public static function builder(): BatchCloseRequestBuilder
    {
        return new BatchCloseRequestBuilder();
    }
}

class BatchCloseRequestBuilder
{
    private BatchCloseRequest $batchCloseRequest;

    public function __construct()
    {
        $this->batchCloseRequest = new BatchCloseRequest();
    }

    public function appId(?string $appId): self { $this->batchCloseRequest->setAppId($appId); return $this; }
    public function merchantId(?string $merchantId): self { $this->batchCloseRequest->setMerchantId($merchantId); return $this; }
    public function transactionRequestId(?string $transactionRequestId): self { $this->batchCloseRequest->setTransactionRequestId($transactionRequestId); return $this; }
    public function terminalSn(?string $terminalSn): self { $this->batchCloseRequest->setTerminalSn($terminalSn); return $this; }
    public function channelCode(?string $channelCode): self { $this->batchCloseRequest->setChannelCode($channelCode); return $this; }
    public function description(?string $description): self { $this->batchCloseRequest->setDescription($description); return $this; }
    public function printReceipt(?BatchPrintReceiptOption $printReceipt): self { $this->batchCloseRequest->setPrintReceipt($printReceipt); return $this; }

    public function build(): BatchCloseRequest
    {
        return $this->batchCloseRequest;
    }
}

