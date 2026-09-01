<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Common;

use Sunmi\Sunbay\Nexus\Enum\SignatureEntryLocation;

/**
 * Signature configuration
 *
 * Replaces the deprecated signatureEntryLocation field.
 * When not provided, the SUNBAY platform signature configuration is used by default.
 *
 * @author Andy Li
 * @since 2026-08-06
 */
class SignatureConfig
{
    public function __construct(
        ?bool $useHostConfig = null,
        ?SignatureEntryLocation $entryLocation = null,
        ?int $threshold = null
    ) {
        if ($useHostConfig !== null) $this->setUseHostConfig($useHostConfig);
        if ($entryLocation !== null) $this->setEntryLocation($entryLocation);
        if ($threshold !== null) $this->setThreshold($threshold);
    }

    /**
     * Whether to use SUNBAY platform signature configuration.
     * When true, entryLocation and threshold are ignored.
     * When false, uses the configuration provided in this request.
     */
    private ?bool $useHostConfig = null;

    /**
     * Signature entry location. Required when useHostConfig is false.
     * Options: ON_SCREEN, ON_RECEIPT, NONE
     */
    private ?SignatureEntryLocation $entryLocation = null;

    /**
     * Signature threshold amount in minor currency units.
     * When transaction amount >= threshold, signature is required.
     * Only effective when useHostConfig is false and entryLocation is not NONE.
     * When not set, signature is required for all amounts.
     */
    private ?int $threshold = null;

    public function getUseHostConfig(): ?bool { return $this->useHostConfig; }
    public function setUseHostConfig(?bool $useHostConfig): self { $this->useHostConfig = $useHostConfig; return $this; }

    public function getEntryLocation(): ?SignatureEntryLocation { return $this->entryLocation; }
    public function setEntryLocation(?SignatureEntryLocation $entryLocation): self { $this->entryLocation = $entryLocation; return $this; }

    public function getThreshold(): ?int { return $this->threshold; }
    public function setThreshold(?int $threshold): self { $this->threshold = $threshold; return $this; }

    public static function builder(): SignatureConfigBuilder
    {
        return new SignatureConfigBuilder();
    }
}

class SignatureConfigBuilder
{
    private SignatureConfig $signatureConfig;

    public function __construct()
    {
        $this->signatureConfig = new SignatureConfig();
    }

    public function useHostConfig(?bool $useHostConfig): self
    {
        $this->signatureConfig->setUseHostConfig($useHostConfig);
        return $this;
    }

    public function entryLocation(?SignatureEntryLocation $entryLocation): self
    {
        $this->signatureConfig->setEntryLocation($entryLocation);
        return $this;
    }

    public function threshold(?int $threshold): self
    {
        $this->signatureConfig->setThreshold($threshold);
        return $this;
    }

    public function build(): SignatureConfig
    {
        return $this->signatureConfig;
    }
}
