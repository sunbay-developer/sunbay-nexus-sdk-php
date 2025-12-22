<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Common;

/**
 * Payment method information
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class PaymentMethodInfo
{
    /**
     * Payment category: CARD (bank card)/CARD-CREDIT (credit card network)/CARD-DEBIT (debit card network)/QR-MPM (QR code merchant present mode)/QR-CPM (QR code customer present mode)
     */
    private ?string $category = null;

    /**
     * Specific payment method: WECHAT (WeChat)/ALIPAY (Alipay) etc. For card payments, usually only category needs to be specified
     */
    private ?string $id = null;

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;
        return $this;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public static function builder(): PaymentMethodInfoBuilder
    {
        return new PaymentMethodInfoBuilder();
    }
}

class PaymentMethodInfoBuilder
{
    private PaymentMethodInfo $paymentMethodInfo;

    public function __construct()
    {
        $this->paymentMethodInfo = new PaymentMethodInfo();
    }

    public function category(?string $category): self
    {
        $this->paymentMethodInfo->setCategory($category);
        return $this;
    }

    public function id(?string $id): self
    {
        $this->paymentMethodInfo->setId($id);
        return $this;
    }

    public function build(): PaymentMethodInfo
    {
        return $this->paymentMethodInfo;
    }
}


