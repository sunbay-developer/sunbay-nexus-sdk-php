<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Response;

use Sunmi\Sunbay\Nexus\Model\Common\Amount;
use Sunmi\Sunbay\Nexus\Model\Common\BaseResponse;

/**
 * Query response
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class QueryResponse extends BaseResponse
{
    private ?string $transactionId = null;
    private ?string $transactionRequestId = null;
    private ?string $referenceOrderId = null;
    private ?string $transactionStatus = null;
    private ?string $transactionType = null;
    private ?Amount $amount = null;
    private ?string $createTime = null;
    private ?string $completeTime = null;
    private ?string $maskedPan = null;
    private ?string $cardNetworkType = null;
    private ?string $paymentMethodId = null;
    private ?string $subPaymentMethodId = null;
    private ?string $batchNo = null;
    private ?string $voucherNo = null;
    private ?string $stan = null;
    private ?string $rrn = null;
    private ?string $authCode = null;
    private ?string $entryMode = null;
    private ?string $authenticationMethod = null;
    private ?string $transactionResultCode = null;
    private ?string $transactionResultMsg = null;
    private ?string $terminalSn = null;
    private ?string $description = null;
    private ?string $attach = null;

    // Getters and setters
    public function getTransactionId(): ?string { return $this->transactionId; }
    public function setTransactionId(?string $transactionId): self { $this->transactionId = $transactionId; return $this; }

    public function getTransactionRequestId(): ?string { return $this->transactionRequestId; }
    public function setTransactionRequestId(?string $transactionRequestId): self { $this->transactionRequestId = $transactionRequestId; return $this; }

    public function getReferenceOrderId(): ?string { return $this->referenceOrderId; }
    public function setReferenceOrderId(?string $referenceOrderId): self { $this->referenceOrderId = $referenceOrderId; return $this; }

    public function getTransactionStatus(): ?string { return $this->transactionStatus; }
    public function setTransactionStatus(?string $transactionStatus): self { $this->transactionStatus = $transactionStatus; return $this; }

    public function getTransactionType(): ?string { return $this->transactionType; }
    public function setTransactionType(?string $transactionType): self { $this->transactionType = $transactionType; return $this; }

    public function getAmount(): ?Amount { return $this->amount; }
    public function setAmount(?Amount $amount): self { $this->amount = $amount; return $this; }

    public function getCreateTime(): ?string { return $this->createTime; }
    public function setCreateTime(?string $createTime): self { $this->createTime = $createTime; return $this; }

    public function getCompleteTime(): ?string { return $this->completeTime; }
    public function setCompleteTime(?string $completeTime): self { $this->completeTime = $completeTime; return $this; }

    public function getMaskedPan(): ?string { return $this->maskedPan; }
    public function setMaskedPan(?string $maskedPan): self { $this->maskedPan = $maskedPan; return $this; }

    public function getCardNetworkType(): ?string { return $this->cardNetworkType; }
    public function setCardNetworkType(?string $cardNetworkType): self { $this->cardNetworkType = $cardNetworkType; return $this; }

    public function getPaymentMethodId(): ?string { return $this->paymentMethodId; }
    public function setPaymentMethodId(?string $paymentMethodId): self { $this->paymentMethodId = $paymentMethodId; return $this; }

    public function getSubPaymentMethodId(): ?string { return $this->subPaymentMethodId; }
    public function setSubPaymentMethodId(?string $subPaymentMethodId): self { $this->subPaymentMethodId = $subPaymentMethodId; return $this; }

    public function getBatchNo(): ?string { return $this->batchNo; }
    public function setBatchNo(?string $batchNo): self { $this->batchNo = $batchNo; return $this; }

    public function getVoucherNo(): ?string { return $this->voucherNo; }
    public function setVoucherNo(?string $voucherNo): self { $this->voucherNo = $voucherNo; return $this; }

    public function getStan(): ?string { return $this->stan; }
    public function setStan(?string $stan): self { $this->stan = $stan; return $this; }

    public function getRrn(): ?string { return $this->rrn; }
    public function setRrn(?string $rrn): self { $this->rrn = $rrn; return $this; }

    public function getAuthCode(): ?string { return $this->authCode; }
    public function setAuthCode(?string $authCode): self { $this->authCode = $authCode; return $this; }

    public function getEntryMode(): ?string { return $this->entryMode; }
    public function setEntryMode(?string $entryMode): self { $this->entryMode = $entryMode; return $this; }

    public function getAuthenticationMethod(): ?string { return $this->authenticationMethod; }
    public function setAuthenticationMethod(?string $authenticationMethod): self { $this->authenticationMethod = $authenticationMethod; return $this; }

    public function getTransactionResultCode(): ?string { return $this->transactionResultCode; }
    public function setTransactionResultCode(?string $transactionResultCode): self { $this->transactionResultCode = $transactionResultCode; return $this; }

    public function getTransactionResultMsg(): ?string { return $this->transactionResultMsg; }
    public function setTransactionResultMsg(?string $transactionResultMsg): self { $this->transactionResultMsg = $transactionResultMsg; return $this; }

    public function getTerminalSn(): ?string { return $this->terminalSn; }
    public function setTerminalSn(?string $terminalSn): self { $this->terminalSn = $terminalSn; return $this; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): self { $this->description = $description; return $this; }

    public function getAttach(): ?string { return $this->attach; }
    public function setAttach(?string $attach): self { $this->attach = $attach; return $this; }
}

