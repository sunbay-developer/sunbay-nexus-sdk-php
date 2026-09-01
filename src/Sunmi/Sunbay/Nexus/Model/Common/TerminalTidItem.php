<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Common;

/**
 * TID information assigned by a payment processor to a terminal
 *
 * @since 2026-09-01
 */
class TerminalTidItem
{
    public function __construct(
        ?string $channelCode = null,
        ?string $channelName = null,
        ?string $tid = null
    ) {
        if ($channelCode !== null) $this->setChannelCode($channelCode);
        if ($channelName !== null) $this->setChannelName($channelName);
        if ($tid !== null) $this->setTid($tid);
    }

    /** Payment channel code identifying the processor this TID belongs to */
    private ?string $channelCode = null;
    /** Payment channel display name (for presentation only) */
    private ?string $channelName = null;
    /** Terminal Identification Number (TID) assigned by the payment processor */
    private ?string $tid = null;

    public function getChannelCode(): ?string { return $this->channelCode; }
    public function setChannelCode(?string $channelCode): self { $this->channelCode = $channelCode; return $this; }

    public function getChannelName(): ?string { return $this->channelName; }
    public function setChannelName(?string $channelName): self { $this->channelName = $channelName; return $this; }

    public function getTid(): ?string { return $this->tid; }
    public function setTid(?string $tid): self { $this->tid = $tid; return $this; }
}
