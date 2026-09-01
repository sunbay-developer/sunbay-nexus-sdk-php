<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Model\Common;

/**
 * Terminal information bound to a merchant
 *
 * @since 2026-09-01
 */
class TerminalItem
{
    public function __construct(
        ?string $sn = null,
        ?string $vendor = null,
        ?string $model = null,
        ?string $createTime = null,
        ?array $tidList = null
    ) {
        if ($sn !== null) $this->setSn($sn);
        if ($vendor !== null) $this->setVendor($vendor);
        if ($model !== null) $this->setModel($model);
        if ($createTime !== null) $this->setCreateTime($createTime);
        if ($tidList !== null) $this->setTidList($tidList);
    }

    /** Terminal serial number */
    private ?string $sn = null;
    /** Device vendor / manufacturer */
    private ?string $vendor = null;
    /** Device model */
    private ?string $model = null;
    /** Time the terminal was bound to the merchant (ISO 8601) */
    private ?string $createTime = null;
    /**
     * TIDs assigned to this terminal by each payment channel (Processor).
     * @var TerminalTidItem[]|null
     */
    private ?array $tidList = null;

    public function getSn(): ?string { return $this->sn; }
    public function setSn(?string $sn): self { $this->sn = $sn; return $this; }

    public function getVendor(): ?string { return $this->vendor; }
    public function setVendor(?string $vendor): self { $this->vendor = $vendor; return $this; }

    public function getModel(): ?string { return $this->model; }
    public function setModel(?string $model): self { $this->model = $model; return $this; }

    public function getCreateTime(): ?string { return $this->createTime; }
    public function setCreateTime(?string $createTime): self { $this->createTime = $createTime; return $this; }

    /** @return TerminalTidItem[]|null */
    public function getTidList(): ?array { return $this->tidList; }
    /** @param TerminalTidItem[]|null $tidList */
    public function setTidList(?array $tidList): self { $this->tidList = $tidList; return $this; }
}
