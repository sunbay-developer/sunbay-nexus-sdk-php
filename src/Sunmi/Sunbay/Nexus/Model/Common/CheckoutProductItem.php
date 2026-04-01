<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Common;

/**
 * Line item for hosted checkout / online checkout productList.
 *
 * @author Andy Li
 * @since 2026-01-28
 */
class CheckoutProductItem
{
    private ?int $amount = null;
    private ?string $name = null;
    private ?int $num = null;

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(?int $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getNum(): ?int
    {
        return $this->num;
    }

    public function setNum(?int $num): self
    {
        $this->num = $num;
        return $this;
    }

    public static function builder(): CheckoutProductItemBuilder
    {
        return new CheckoutProductItemBuilder();
    }
}

class CheckoutProductItemBuilder
{
    private CheckoutProductItem $item;

    public function __construct()
    {
        $this->item = new CheckoutProductItem();
    }

    public function amount(?int $amount): self
    {
        $this->item->setAmount($amount);
        return $this;
    }

    public function name(?string $name): self
    {
        $this->item->setName($name);
        return $this;
    }

    public function num(?int $num): self
    {
        $this->item->setNum($num);
        return $this;
    }

    public function build(): CheckoutProductItem
    {
        return $this->item;
    }
}
