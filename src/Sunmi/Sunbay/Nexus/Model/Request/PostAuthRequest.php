<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Request;

use Sunmi\Sunbay\Nexus\Model\Common\PostAuthAmount;

/**
 * Post authorization request
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class PostAuthRequest
{
    private ?string $appId = null;
    private ?string $merchantId = null;
    private ?string $originalTransactionId = null;
    private ?string $originalTransactionRequestId = null;
    private ?string $transactionRequestId = null;
    private ?PostAuthAmount $amount = null;
    private ?string $description = null;
    private ?string $terminalSn = null;
    private ?string $attach = null;
    private ?string $notifyUrl = null;

    // Getters and setters
    public function getAppId(): ?string { return $this->appId; }
    public function setAppId(?string $appId): self { $this->appId = $appId; return $this; }

    public function getMerchantId(): ?string { return $this->merchantId; }
    public function setMerchantId(?string $merchantId): self { $this->merchantId = $merchantId; return $this; }

    public function getOriginalTransactionId(): ?string { return $this->originalTransactionId; }
    public function setOriginalTransactionId(?string $originalTransactionId): self { $this->originalTransactionId = $originalTransactionId; return $this; }

    public function getOriginalTransactionRequestId(): ?string { return $this->originalTransactionRequestId; }
    public function setOriginalTransactionRequestId(?string $originalTransactionRequestId): self { $this->originalTransactionRequestId = $originalTransactionRequestId; return $this; }

    public function getTransactionRequestId(): ?string { return $this->transactionRequestId; }
    public function setTransactionRequestId(?string $transactionRequestId): self { $this->transactionRequestId = $transactionRequestId; return $this; }

    public function getAmount(): ?PostAuthAmount { return $this->amount; }
    public function setAmount(?PostAuthAmount $amount): self { $this->amount = $amount; return $this; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): self { $this->description = $description; return $this; }

    public function getTerminalSn(): ?string { return $this->terminalSn; }
    public function setTerminalSn(?string $terminalSn): self { $this->terminalSn = $terminalSn; return $this; }

    public function getAttach(): ?string { return $this->attach; }
    public function setAttach(?string $attach): self { $this->attach = $attach; return $this; }

    public function getNotifyUrl(): ?string { return $this->notifyUrl; }
    public function setNotifyUrl(?string $notifyUrl): self { $this->notifyUrl = $notifyUrl; return $this; }

    public static function builder(): PostAuthRequestBuilder
    {
        return new PostAuthRequestBuilder();
    }
}

class PostAuthRequestBuilder
{
    private PostAuthRequest $postAuthRequest;

    public function __construct()
    {
        $this->postAuthRequest = new PostAuthRequest();
    }

    public function appId(?string $appId): self { $this->postAuthRequest->setAppId($appId); return $this; }
    public function merchantId(?string $merchantId): self { $this->postAuthRequest->setMerchantId($merchantId); return $this; }
    public function originalTransactionId(?string $originalTransactionId): self { $this->postAuthRequest->setOriginalTransactionId($originalTransactionId); return $this; }
    public function originalTransactionRequestId(?string $originalTransactionRequestId): self { $this->postAuthRequest->setOriginalTransactionRequestId($originalTransactionRequestId); return $this; }
    public function transactionRequestId(?string $transactionRequestId): self { $this->postAuthRequest->setTransactionRequestId($transactionRequestId); return $this; }
    public function amount(?PostAuthAmount $amount): self { $this->postAuthRequest->setAmount($amount); return $this; }
    public function description(?string $description): self { $this->postAuthRequest->setDescription($description); return $this; }
    public function terminalSn(?string $terminalSn): self { $this->postAuthRequest->setTerminalSn($terminalSn); return $this; }
    public function attach(?string $attach): self { $this->postAuthRequest->setAttach($attach); return $this; }
    public function notifyUrl(?string $notifyUrl): self { $this->postAuthRequest->setNotifyUrl($notifyUrl); return $this; }

    public function build(): PostAuthRequest
    {
        return $this->postAuthRequest;
    }
}

