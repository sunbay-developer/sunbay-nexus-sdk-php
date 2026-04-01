<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Common;

/**
 * Billing or shipping address for online checkout (POST /v1/checkout/sale).
 *
 * @author Andy Li
 * @since 2026-01-28
 */
class CheckoutAddress
{
    private ?string $line1 = null;
    private ?string $line2 = null;
    private ?string $city = null;
    private ?string $state = null;
    private ?string $postalCode = null;
    private ?string $country = null;

    public function getLine1(): ?string
    {
        return $this->line1;
    }

    public function setLine1(?string $line1): self
    {
        $this->line1 = $line1;
        return $this;
    }

    public function getLine2(): ?string
    {
        return $this->line2;
    }

    public function setLine2(?string $line2): self
    {
        $this->line2 = $line2;
        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;
        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): self
    {
        $this->state = $state;
        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;
        return $this;
    }

    public static function builder(): CheckoutAddressBuilder
    {
        return new CheckoutAddressBuilder();
    }
}

class CheckoutAddressBuilder
{
    private CheckoutAddress $address;

    public function __construct()
    {
        $this->address = new CheckoutAddress();
    }

    public function line1(?string $line1): self
    {
        $this->address->setLine1($line1);
        return $this;
    }

    public function line2(?string $line2): self
    {
        $this->address->setLine2($line2);
        return $this;
    }

    public function city(?string $city): self
    {
        $this->address->setCity($city);
        return $this;
    }

    public function state(?string $state): self
    {
        $this->address->setState($state);
        return $this;
    }

    public function postalCode(?string $postalCode): self
    {
        $this->address->setPostalCode($postalCode);
        return $this;
    }

    public function country(?string $country): self
    {
        $this->address->setCountry($country);
        return $this;
    }

    public function build(): CheckoutAddress
    {
        return $this->address;
    }
}
