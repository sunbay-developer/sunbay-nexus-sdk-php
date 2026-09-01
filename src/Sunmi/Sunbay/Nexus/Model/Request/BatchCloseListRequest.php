<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Request;

/**
 * Batch close list request
 *
 * Query closed (settled) batch records. You can filter results by payment channel
 * and time range. If no time range is specified, the API returns data from the last
 * 7 days by default. The maximum query span is 30 days.
 *
 * @since 2026-09-01
 */
class BatchCloseListRequest
{
    public function __construct(
        ?string $appId = null,
        ?string $merchantId = null,
        ?string $terminalSn = null,
        ?string $channelCode = null,
        ?string $startTime = null,
        ?string $endTime = null
    ) {
        if ($appId !== null) $this->setAppId($appId);
        if ($merchantId !== null) $this->setMerchantId($merchantId);
        if ($terminalSn !== null) $this->setTerminalSn($terminalSn);
        if ($channelCode !== null) $this->setChannelCode($channelCode);
        if ($startTime !== null) $this->setStartTime($startTime);
        if ($endTime !== null) $this->setEndTime($endTime);
    }

    private ?string $appId = null;
    private ?string $merchantId = null;
    /** Payment terminal serial number */
    private ?string $terminalSn = null;
    /** Payment channel code. If specified, only returns batches for this channel */
    private ?string $channelCode = null;
    /** Query start time, ISO 8601 format. Must pair with endTime. Max span 30 days */
    private ?string $startTime = null;
    /** Query end time, ISO 8601 format. Must pair with startTime. Max span 30 days */
    private ?string $endTime = null;

    public function getAppId(): ?string { return $this->appId; }
    public function setAppId(?string $appId): self { $this->appId = $appId; return $this; }

    public function getMerchantId(): ?string { return $this->merchantId; }
    public function setMerchantId(?string $merchantId): self { $this->merchantId = $merchantId; return $this; }

    public function getTerminalSn(): ?string { return $this->terminalSn; }
    public function setTerminalSn(?string $terminalSn): self { $this->terminalSn = $terminalSn; return $this; }

    public function getChannelCode(): ?string { return $this->channelCode; }
    public function setChannelCode(?string $channelCode): self { $this->channelCode = $channelCode; return $this; }

    public function getStartTime(): ?string { return $this->startTime; }
    public function setStartTime(?string $startTime): self { $this->startTime = $startTime; return $this; }

    public function getEndTime(): ?string { return $this->endTime; }
    public function setEndTime(?string $endTime): self { $this->endTime = $endTime; return $this; }

    public static function builder(): BatchCloseListRequestBuilder
    {
        return new BatchCloseListRequestBuilder();
    }
}

class BatchCloseListRequestBuilder
{
    private BatchCloseListRequest $request;

    public function __construct()
    {
        $this->request = new BatchCloseListRequest();
    }

    public function appId(?string $appId): self { $this->request->setAppId($appId); return $this; }
    public function merchantId(?string $merchantId): self { $this->request->setMerchantId($merchantId); return $this; }
    public function terminalSn(?string $terminalSn): self { $this->request->setTerminalSn($terminalSn); return $this; }
    public function channelCode(?string $channelCode): self { $this->request->setChannelCode($channelCode); return $this; }
    public function startTime(?string $startTime): self { $this->request->setStartTime($startTime); return $this; }
    public function endTime(?string $endTime): self { $this->request->setEndTime($endTime); return $this; }

    public function build(): BatchCloseListRequest
    {
        return $this->request;
    }
}
