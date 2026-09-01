<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Response;

use Sunmi\Sunbay\Nexus\Model\Common\BaseResponse;

/**
 * Merchant terminals query response
 *
 * @since 2026-09-01
 */
class MerchantTerminalsQueryResponse extends BaseResponse
{
    /** Merchant ID (echoed from the request) */
    private ?string $merchantId = null;
    /** Opaque pagination token for the next page; absent when no more data */
    private ?string $nextToken = null;
    /**
     * Terminals on the current page
     * @var \Sunmi\Sunbay\Nexus\Model\Common\TerminalItem[]|null
     */
    private ?array $terminals = null;

    public function getMerchantId(): ?string { return $this->merchantId; }
    public function setMerchantId(?string $merchantId): self { $this->merchantId = $merchantId; return $this; }

    public function getNextToken(): ?string { return $this->nextToken; }
    public function setNextToken(?string $nextToken): self { $this->nextToken = $nextToken; return $this; }

    /** @return \Sunmi\Sunbay\Nexus\Model\Common\TerminalItem[]|null */
    public function getTerminals(): ?array { return $this->terminals; }
    /** @param \Sunmi\Sunbay\Nexus\Model\Common\TerminalItem[]|null $terminals */
    public function setTerminals(?array $terminals): self { $this->terminals = $terminals; return $this; }
}
