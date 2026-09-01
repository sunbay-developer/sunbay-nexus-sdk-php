<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Common;

/**
 * MID information assigned by a payment processor
 *
 * @since 2026-09-01
 */
class MerchantMidItem
{
    public function __construct(
        ?string $channelCode = null,
        ?string $channelName = null,
        ?string $mid = null
    ) {
        if ($channelCode !== null) $this->setChannelCode($channelCode);
        if ($channelName !== null) $this->setChannelName($channelName);
        if ($mid !== null) $this->setMid($mid);
    }

    /** Payment channel code identifying the processor this MID belongs to */
    private ?string $channelCode = null;
    /** Payment channel display name (for presentation only) */
    private ?string $channelName = null;
    /** Merchant Identification Number (MID) assigned by the payment processor */
    private ?string $mid = null;

    public function getChannelCode(): ?string { return $this->channelCode; }
    public function setChannelCode(?string $channelCode): self { $this->channelCode = $channelCode; return $this; }

    public function getChannelName(): ?string { return $this->channelName; }
    public function setChannelName(?string $channelName): self { $this->channelName = $channelName; return $this; }

    public function getMid(): ?string { return $this->mid; }
    public function setMid(?string $mid): self { $this->mid = $mid; return $this; }
}
