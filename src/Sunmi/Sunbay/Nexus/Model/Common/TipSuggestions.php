<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Common;

/**
 * Tip suggestions configuration
 *
 * @author Andy Li
 * @since 2025-05-15
 */
class TipSuggestions
{
    /**
     * Fee mode: RATE or AMOUNT
     */
    private ?string $feeMode = null;

    /**
     * Suggestion values (e.g., [15, 18, 20] for RATE mode means 15%, 18%, 20%)
     *
     * @var int[]|null
     */
    private ?array $values = null;

    public function getFeeMode(): ?string
    {
        return $this->feeMode;
    }

    public function setFeeMode(?string $feeMode): self
    {
        $this->feeMode = $feeMode;
        return $this;
    }

    /**
     * @return int[]|null
     */
    public function getValues(): ?array
    {
        return $this->values;
    }

    /**
     * @param int[]|null $values
     */
    public function setValues(?array $values): self
    {
        $this->values = $values;
        return $this;
    }

    public static function builder(): TipSuggestionsBuilder
    {
        return new TipSuggestionsBuilder();
    }
}

class TipSuggestionsBuilder
{
    private TipSuggestions $tipSuggestions;

    public function __construct()
    {
        $this->tipSuggestions = new TipSuggestions();
    }

    public function feeMode(?string $feeMode): self
    {
        $this->tipSuggestions->setFeeMode($feeMode);
        return $this;
    }

    /**
     * @param int[]|null $values
     */
    public function values(?array $values): self
    {
        $this->tipSuggestions->setValues($values);
        return $this;
    }

    public function build(): TipSuggestions
    {
        return $this->tipSuggestions;
    }
}
