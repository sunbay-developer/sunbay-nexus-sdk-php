<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Request;

use Sunmi\Sunbay\Nexus\Model\Common\CheckoutProductItem;
use Sunmi\Sunbay\Nexus\Model\Common\SaleAmount;

/**
 * POST /v1/checkout/create-session — hosted payment page session.
 *
 * @author Andy Li
 * @since 2026-01-28
 */
class CreateCheckoutSessionRequest
{
    private ?string $appId = null;
    private ?string $transactionRequestId = null;
    private ?string $referenceOrderId = null;
    private ?string $merchantId = null;
    private ?SaleAmount $amount = null;
    private ?string $description = null;
    /** @var array<int, CheckoutProductItem>|null */
    private ?array $productList = null;
    private ?bool $collectBillingAddress = null;
    private ?bool $collectShippingAddress = null;
    private ?string $merchantReturnUrl = null;
    private ?string $notifyUrl = null;

    public function getAppId(): ?string { return $this->appId; }
    public function setAppId(?string $appId): self { $this->appId = $appId; return $this; }

    public function getTransactionRequestId(): ?string { return $this->transactionRequestId; }
    public function setTransactionRequestId(?string $transactionRequestId): self { $this->transactionRequestId = $transactionRequestId; return $this; }

    public function getReferenceOrderId(): ?string { return $this->referenceOrderId; }
    public function setReferenceOrderId(?string $referenceOrderId): self { $this->referenceOrderId = $referenceOrderId; return $this; }

    public function getMerchantId(): ?string { return $this->merchantId; }
    public function setMerchantId(?string $merchantId): self { $this->merchantId = $merchantId; return $this; }

    public function getAmount(): ?SaleAmount { return $this->amount; }
    public function setAmount(?SaleAmount $amount): self { $this->amount = $amount; return $this; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): self { $this->description = $description; return $this; }

    /** @return array<int, CheckoutProductItem>|null */
    public function getProductList(): ?array { return $this->productList; }

    /** @param array<int, CheckoutProductItem>|null $productList */
    public function setProductList(?array $productList): self { $this->productList = $productList; return $this; }

    public function getCollectBillingAddress(): ?bool { return $this->collectBillingAddress; }
    public function setCollectBillingAddress(?bool $collectBillingAddress): self { $this->collectBillingAddress = $collectBillingAddress; return $this; }

    public function getCollectShippingAddress(): ?bool { return $this->collectShippingAddress; }
    public function setCollectShippingAddress(?bool $collectShippingAddress): self { $this->collectShippingAddress = $collectShippingAddress; return $this; }

    public function getMerchantReturnUrl(): ?string { return $this->merchantReturnUrl; }
    public function setMerchantReturnUrl(?string $merchantReturnUrl): self { $this->merchantReturnUrl = $merchantReturnUrl; return $this; }

    public function getNotifyUrl(): ?string { return $this->notifyUrl; }
    public function setNotifyUrl(?string $notifyUrl): self { $this->notifyUrl = $notifyUrl; return $this; }

    public static function builder(): CreateCheckoutSessionRequestBuilder
    {
        return new CreateCheckoutSessionRequestBuilder();
    }
}

class CreateCheckoutSessionRequestBuilder
{
    private CreateCheckoutSessionRequest $request;

    public function __construct()
    {
        $this->request = new CreateCheckoutSessionRequest();
    }

    public function appId(?string $appId): self { $this->request->setAppId($appId); return $this; }
    public function transactionRequestId(?string $transactionRequestId): self { $this->request->setTransactionRequestId($transactionRequestId); return $this; }
    public function referenceOrderId(?string $referenceOrderId): self { $this->request->setReferenceOrderId($referenceOrderId); return $this; }
    public function merchantId(?string $merchantId): self { $this->request->setMerchantId($merchantId); return $this; }
    public function amount(?SaleAmount $amount): self { $this->request->setAmount($amount); return $this; }
    public function description(?string $description): self { $this->request->setDescription($description); return $this; }

    /** @param array<int, CheckoutProductItem>|null $productList */
    public function productList(?array $productList): self { $this->request->setProductList($productList); return $this; }

    public function collectBillingAddress(?bool $collectBillingAddress): self { $this->request->setCollectBillingAddress($collectBillingAddress); return $this; }
    public function collectShippingAddress(?bool $collectShippingAddress): self { $this->request->setCollectShippingAddress($collectShippingAddress); return $this; }
    public function merchantReturnUrl(?string $merchantReturnUrl): self { $this->request->setMerchantReturnUrl($merchantReturnUrl); return $this; }
    public function notifyUrl(?string $notifyUrl): self { $this->request->setNotifyUrl($notifyUrl); return $this; }

    public function build(): CreateCheckoutSessionRequest
    {
        return $this->request;
    }
}
