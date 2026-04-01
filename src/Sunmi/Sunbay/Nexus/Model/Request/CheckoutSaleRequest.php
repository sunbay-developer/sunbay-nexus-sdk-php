<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Request;

use Sunmi\Sunbay\Nexus\Enum\OnlineWalletPaymentMethod;
use Sunmi\Sunbay\Nexus\Model\Common\CheckoutAddress;
use Sunmi\Sunbay\Nexus\Model\Common\CheckoutProductItem;
use Sunmi\Sunbay\Nexus\Model\Common\SaleAmount;

/**
 * POST /v1/checkout/sale — direct online payment (e.g. Google Pay / Apple Pay).
 *
 * @author Andy Li
 * @since 2026-01-28
 */
class CheckoutSaleRequest
{
    private ?string $appId = null;
    private ?string $merchantId = null;
    private ?string $transactionRequestId = null;
    private ?string $referenceOrderId = null;
    private ?string $description = null;
    private ?SaleAmount $amount = null;
    /** @var array<int, CheckoutProductItem>|null */
    private ?array $productList = null;
    private ?OnlineWalletPaymentMethod $paymentMethod = null;
    private ?string $cardEncryptedData = null;
    private ?string $customerEmail = null;
    private ?string $customerName = null;
    private ?CheckoutAddress $billingAddress = null;
    private ?CheckoutAddress $shippingAddress = null;
    private ?string $notifyUrl = null;
    private ?string $merchantReturnUrl = null;

    public function getAppId(): ?string { return $this->appId; }
    public function setAppId(?string $appId): self { $this->appId = $appId; return $this; }

    public function getMerchantId(): ?string { return $this->merchantId; }
    public function setMerchantId(?string $merchantId): self { $this->merchantId = $merchantId; return $this; }

    public function getTransactionRequestId(): ?string { return $this->transactionRequestId; }
    public function setTransactionRequestId(?string $transactionRequestId): self { $this->transactionRequestId = $transactionRequestId; return $this; }

    public function getReferenceOrderId(): ?string { return $this->referenceOrderId; }
    public function setReferenceOrderId(?string $referenceOrderId): self { $this->referenceOrderId = $referenceOrderId; return $this; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): self { $this->description = $description; return $this; }

    public function getAmount(): ?SaleAmount { return $this->amount; }
    public function setAmount(?SaleAmount $amount): self { $this->amount = $amount; return $this; }

    /** @return array<int, CheckoutProductItem>|null */
    public function getProductList(): ?array { return $this->productList; }

    /** @param array<int, CheckoutProductItem>|null $productList */
    public function setProductList(?array $productList): self { $this->productList = $productList; return $this; }

    public function getPaymentMethod(): ?OnlineWalletPaymentMethod { return $this->paymentMethod; }
    public function setPaymentMethod(?OnlineWalletPaymentMethod $paymentMethod): self { $this->paymentMethod = $paymentMethod; return $this; }

    public function getCardEncryptedData(): ?string { return $this->cardEncryptedData; }
    public function setCardEncryptedData(?string $cardEncryptedData): self { $this->cardEncryptedData = $cardEncryptedData; return $this; }

    public function getCustomerEmail(): ?string { return $this->customerEmail; }
    public function setCustomerEmail(?string $customerEmail): self { $this->customerEmail = $customerEmail; return $this; }

    public function getCustomerName(): ?string { return $this->customerName; }
    public function setCustomerName(?string $customerName): self { $this->customerName = $customerName; return $this; }

    public function getBillingAddress(): ?CheckoutAddress { return $this->billingAddress; }
    public function setBillingAddress(?CheckoutAddress $billingAddress): self { $this->billingAddress = $billingAddress; return $this; }

    public function getShippingAddress(): ?CheckoutAddress { return $this->shippingAddress; }
    public function setShippingAddress(?CheckoutAddress $shippingAddress): self { $this->shippingAddress = $shippingAddress; return $this; }

    public function getNotifyUrl(): ?string { return $this->notifyUrl; }
    public function setNotifyUrl(?string $notifyUrl): self { $this->notifyUrl = $notifyUrl; return $this; }

    public function getMerchantReturnUrl(): ?string { return $this->merchantReturnUrl; }
    public function setMerchantReturnUrl(?string $merchantReturnUrl): self { $this->merchantReturnUrl = $merchantReturnUrl; return $this; }

    public static function builder(): CheckoutSaleRequestBuilder
    {
        return new CheckoutSaleRequestBuilder();
    }
}

class CheckoutSaleRequestBuilder
{
    private CheckoutSaleRequest $request;

    public function __construct()
    {
        $this->request = new CheckoutSaleRequest();
    }

    public function appId(?string $appId): self { $this->request->setAppId($appId); return $this; }
    public function merchantId(?string $merchantId): self { $this->request->setMerchantId($merchantId); return $this; }
    public function transactionRequestId(?string $transactionRequestId): self { $this->request->setTransactionRequestId($transactionRequestId); return $this; }
    public function referenceOrderId(?string $referenceOrderId): self { $this->request->setReferenceOrderId($referenceOrderId); return $this; }
    public function description(?string $description): self { $this->request->setDescription($description); return $this; }
    public function amount(?SaleAmount $amount): self { $this->request->setAmount($amount); return $this; }

    /** @param array<int, CheckoutProductItem>|null $productList */
    public function productList(?array $productList): self { $this->request->setProductList($productList); return $this; }

    public function paymentMethod(?OnlineWalletPaymentMethod $paymentMethod): self { $this->request->setPaymentMethod($paymentMethod); return $this; }
    public function cardEncryptedData(?string $cardEncryptedData): self { $this->request->setCardEncryptedData($cardEncryptedData); return $this; }
    public function customerEmail(?string $customerEmail): self { $this->request->setCustomerEmail($customerEmail); return $this; }
    public function customerName(?string $customerName): self { $this->request->setCustomerName($customerName); return $this; }
    public function billingAddress(?CheckoutAddress $billingAddress): self { $this->request->setBillingAddress($billingAddress); return $this; }
    public function shippingAddress(?CheckoutAddress $shippingAddress): self { $this->request->setShippingAddress($shippingAddress); return $this; }
    public function notifyUrl(?string $notifyUrl): self { $this->request->setNotifyUrl($notifyUrl); return $this; }
    public function merchantReturnUrl(?string $merchantReturnUrl): self { $this->request->setMerchantReturnUrl($merchantReturnUrl); return $this; }

    public function build(): CheckoutSaleRequest
    {
        return $this->request;
    }
}
