<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Response;

use Sunmi\Sunbay\Nexus\Model\Common\BaseResponse;

/**
 * Batch close list response
 *
 * @since 2026-09-01
 */
class BatchCloseListResponse extends BaseResponse
{
    /**
     * List of closed batch records
     * @var \Sunmi\Sunbay\Nexus\Model\Common\BatchCloseListItem[]|null
     */
    private ?array $batchCloseList = null;

    /** @return \Sunmi\Sunbay\Nexus\Model\Common\BatchCloseListItem[]|null */
    public function getBatchCloseList(): ?array { return $this->batchCloseList; }
    /** @param \Sunmi\Sunbay\Nexus\Model\Common\BatchCloseListItem[]|null $batchCloseList */
    public function setBatchCloseList(?array $batchCloseList): self { $this->batchCloseList = $batchCloseList; return $this; }
}
