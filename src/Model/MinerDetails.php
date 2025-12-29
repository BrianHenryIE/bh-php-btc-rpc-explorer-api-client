<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

/**
 * Part of MinerSummary response.
 *
 * @see MinerSummary
 */
readonly class MinerDetails
{
    /**
     * @param int[] $blocks
     */
    public function __construct(
        public string $name,
        public MinerInfo $details,
        public array $blocks,
        public string $totalFees,
        public string $totalSubsidy,
        public int $totalTransactions,
        public int $totalWeight,
        public int $subsidyCount,
    ) {
    }
}
