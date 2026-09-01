<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Response;

use Sunmi\Sunbay\Nexus\Model\Common\BaseResponse;

/**
 * Merchant query response
 *
 * @since 2026-09-01
 */
class MerchantQueryResponse extends BaseResponse
{
    private ?string $merchantId = null;
    /** "Doing Business As" name — the merchant's public/trading name */
    private ?string $dbaName = null;
    /** Merchant Category Code (ISO 18245) */
    private ?string $mcc = null;
    /** URL of the merchant logo */
    private ?string $logo = null;
    /** URL of the merchant's small icon / favicon */
    private ?string $smallLogo = null;
    /** ISO 3166-1 alpha-3 country code */
    private ?string $country = null;
    /** State or province name */
    private ?string $stateName = null;
    /** City name */
    private ?string $cityName = null;
    /** Street address */
    private ?string $street = null;
    /** Full detailed address */
    private ?string $detailAddress = null;
    /** Postal / ZIP code */
    private ?string $zipCode = null;
    /** Merchant status. Y: active, N: inactive */
    private ?string $status = null;
    /** Merchant creation time (ISO 8601) */
    private ?string $createTime = null;
    /**
     * MIDs assigned to this merchant by each payment channel (Processor).
     * @var \Sunmi\Sunbay\Nexus\Model\Common\MerchantMidItem[]|null
     */
    private ?array $midList = null;

    public function getMerchantId(): ?string { return $this->merchantId; }
    public function setMerchantId(?string $merchantId): self { $this->merchantId = $merchantId; return $this; }

    public function getDbaName(): ?string { return $this->dbaName; }
    public function setDbaName(?string $dbaName): self { $this->dbaName = $dbaName; return $this; }

    public function getMcc(): ?string { return $this->mcc; }
    public function setMcc(?string $mcc): self { $this->mcc = $mcc; return $this; }

    public function getLogo(): ?string { return $this->logo; }
    public function setLogo(?string $logo): self { $this->logo = $logo; return $this; }

    public function getSmallLogo(): ?string { return $this->smallLogo; }
    public function setSmallLogo(?string $smallLogo): self { $this->smallLogo = $smallLogo; return $this; }

    public function getCountry(): ?string { return $this->country; }
    public function setCountry(?string $country): self { $this->country = $country; return $this; }

    public function getStateName(): ?string { return $this->stateName; }
    public function setStateName(?string $stateName): self { $this->stateName = $stateName; return $this; }

    public function getCityName(): ?string { return $this->cityName; }
    public function setCityName(?string $cityName): self { $this->cityName = $cityName; return $this; }

    public function getStreet(): ?string { return $this->street; }
    public function setStreet(?string $street): self { $this->street = $street; return $this; }

    public function getDetailAddress(): ?string { return $this->detailAddress; }
    public function setDetailAddress(?string $detailAddress): self { $this->detailAddress = $detailAddress; return $this; }

    public function getZipCode(): ?string { return $this->zipCode; }
    public function setZipCode(?string $zipCode): self { $this->zipCode = $zipCode; return $this; }

    public function getStatus(): ?string { return $this->status; }
    public function setStatus(?string $status): self { $this->status = $status; return $this; }

    public function getCreateTime(): ?string { return $this->createTime; }
    public function setCreateTime(?string $createTime): self { $this->createTime = $createTime; return $this; }

    /** @return \Sunmi\Sunbay\Nexus\Model\Common\MerchantMidItem[]|null */
    public function getMidList(): ?array { return $this->midList; }
    /** @param \Sunmi\Sunbay\Nexus\Model\Common\MerchantMidItem[]|null $midList */
    public function setMidList(?array $midList): self { $this->midList = $midList; return $this; }
}
