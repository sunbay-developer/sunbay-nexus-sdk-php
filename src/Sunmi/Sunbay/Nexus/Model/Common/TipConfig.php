<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Common;

use InvalidArgumentException;

/**
 * Tip configuration
 *
 * @author Andy Li
 * @since 2025-05-15
 */
class TipConfig
{
    /**
     * Whether to show on-screen tip prompt
     */
    private ?bool $onScreenTip = null;

    /**
     * Tip mode: ON_SALE or AFTER_SALE
     */
    private ?string $tipMode = null;

    /**
     * Whether tip includes tax
     */
    private ?bool $tipWithTax = null;

    /**
     * Tip suggestions configuration, max 3
     *
     * @var TipSuggestions[]|null
     */
    private ?array $suggestions = null;

    public function getOnScreenTip(): ?bool
    {
        return $this->onScreenTip;
    }

    public function setOnScreenTip(?bool $onScreenTip): self
    {
        $this->onScreenTip = $onScreenTip;
        return $this;
    }

    public function getTipMode(): ?string
    {
        return $this->tipMode;
    }

    public function setTipMode(?string $tipMode): self
    {
        $this->tipMode = $tipMode;
        return $this;
    }

    public function getTipWithTax(): ?bool
    {
        return $this->tipWithTax;
    }

    public function setTipWithTax(?bool $tipWithTax): self
    {
        $this->tipWithTax = $tipWithTax;
        return $this;
    }

    /**
     * @return TipSuggestions[]|null
     */
    public function getSuggestions(): ?array
    {
        return $this->suggestions;
    }

    /**
     * @param TipSuggestions[]|null $suggestions
     */
    public function setSuggestions(?array $suggestions): self
    {
        if ($suggestions !== null) {
            if (count($suggestions) > 3) {
                throw new InvalidArgumentException('Tip suggestions can contain at most 3 items.');
            }

            foreach ($suggestions as $suggestion) {
                if (!$suggestion instanceof TipSuggestions) {
                    throw new InvalidArgumentException('Each tip suggestion must be an instance of ' . TipSuggestions::class . '.');
                }
            }
        }

        $this->suggestions = $suggestions;
        return $this;
    }

    public static function builder(): TipConfigBuilder
    {
        return new TipConfigBuilder();
    }
}

class TipConfigBuilder
{
    private TipConfig $tipConfig;

    public function __construct()
    {
        $this->tipConfig = new TipConfig();
    }

    public function onScreenTip(?bool $onScreenTip): self
    {
        $this->tipConfig->setOnScreenTip($onScreenTip);
        return $this;
    }

    public function tipMode(?string $tipMode): self
    {
        $this->tipConfig->setTipMode($tipMode);
        return $this;
    }

    public function tipWithTax(?bool $tipWithTax): self
    {
        $this->tipConfig->setTipWithTax($tipWithTax);
        return $this;
    }

    /**
     * @param TipSuggestions[]|null $suggestions
     */
    public function suggestions(?array $suggestions): self
    {
        $this->tipConfig->setSuggestions($suggestions);
        return $this;
    }

    public function build(): TipConfig
    {
        return $this->tipConfig;
    }
}
