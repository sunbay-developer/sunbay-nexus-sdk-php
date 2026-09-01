<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Common;

use InvalidArgumentException;

/**
 * Tip suggestions configuration
 *
 * @author Andy Li
 * @since 2025-05-15
 */
class TipSuggestions
{
    public function __construct(
        ?array $names = null,
        ?string $feeMode = null,
        ?array $values = null
    ) {
        if ($names !== null) $this->setNames($names);
        if ($feeMode !== null) $this->setFeeMode($feeMode);
        if ($values !== null) $this->setValues($values);
    }

    /**
     * Display names for tip options
     */
    private ?array $names = null;

    /**
     * Fee mode: RATE or AMOUNT
     */
    private ?string $feeMode = null;

    /**
     * Suggestion values (e.g., [15, 18, 20] for RATE mode means 15%, 18%, 20%), max 3
     *
     * @var float[]|null
     */
    private ?array $values = null;

    /**
     * @return string[]|null
     */
    public function getNames(): ?array
    {
        return $this->names;
    }

    /**
     * @param string[]|null $names
     */
    public function setNames(?array $names): self
    {
        if ($names !== null && count($names) > 3) {
            throw new InvalidArgumentException('Tip suggestion names can contain at most 3 items.');
        }

        if ($names !== null) {
            foreach ($names as $name) {
                if (!is_string($name)) {
                    throw new InvalidArgumentException('Each tip suggestion name must be a string.');
                }
            }
        }

        $this->names = $names;
        $this->assertNamesAndValuesMatch();
        return $this;
    }

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
     * @return float[]|null
     */
    public function getValues(): ?array
    {
        return $this->values;
    }

    /**
     * @param float[]|null $values
     */
    public function setValues(?array $values): self
    {
        if ($values !== null && count($values) > 3) {
            throw new InvalidArgumentException('Tip suggestion values can contain at most 3 items.');
        }

        if ($values !== null) {
            foreach ($values as $value) {
                if (!is_int($value) && !is_float($value)) {
                    throw new InvalidArgumentException('Each tip suggestion value must be numeric.');
                }
            }
        }

        $this->values = $values;
        $this->assertNamesAndValuesMatch();
        return $this;
    }

    private function assertNamesAndValuesMatch(): void
    {
        if ($this->names === null || $this->names === [] || $this->values === null) {
            return;
        }

        if (count($this->names) !== count($this->values)) {
            throw new InvalidArgumentException('Tip suggestion names must have the same length as values.');
        }
    }

    public function validateBeforeBuild(): void
    {
        if ($this->names !== null && count($this->names) > 3) {
            throw new InvalidArgumentException('Tip suggestion names can contain at most 3 items.');
        }

        if ($this->values !== null && count($this->values) > 3) {
            throw new InvalidArgumentException('Tip suggestion values can contain at most 3 items.');
        }

        if ($this->names !== null && $this->names !== [] && $this->values === null) {
            throw new InvalidArgumentException('Tip suggestion names must have the same length as values.');
        }

        $this->assertNamesAndValuesMatch();
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

    /**
     * @param string[]|null $names
     */
    public function names(?array $names): self
    {
        $this->tipSuggestions->setNames($names);
        return $this;
    }

    public function feeMode(?string $feeMode): self
    {
        $this->tipSuggestions->setFeeMode($feeMode);
        return $this;
    }

    /**
     * @param float[]|null $values
     */
    public function values(?array $values): self
    {
        $this->tipSuggestions->setValues($values);
        return $this;
    }

    public function build(): TipSuggestions
    {
        $this->tipSuggestions->validateBeforeBuild();
        return $this->tipSuggestions;
    }
}
