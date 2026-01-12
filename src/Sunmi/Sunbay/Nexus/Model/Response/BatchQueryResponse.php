<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Response;

use Sunmi\Sunbay\Nexus\Model\Common\BaseResponse;
use Sunmi\Sunbay\Nexus\Model\Common\BatchQueryItem;

/**
 * Batch query response
 *
 * @author Andy Li
 * @since 2025-12-26
 */
class BatchQueryResponse extends BaseResponse
{
    /**
     * @var BatchQueryItem[]|null Batch list, statistics grouped by channel code and price currency
     */
    private ?array $batchList = null;

    /**
     * @return BatchQueryItem[]|null
     */
    public function getBatchList(): ?array
    {
        return $this->batchList;
    }

    /**
     * @param BatchQueryItem[]|null $batchList
     * @return self
     */
    public function setBatchList(?array $batchList): self
    {
        $this->batchList = $batchList;
        return $this;
    }
}

