<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

/**
 * Part of MinerSummary response.
 *
 * @see MinerSummary
 */
readonly class OverallMiningStats
{
    public function __construct(
        public int $blockCount,
        public string $totalFees,
        public string $totalSubsidy,
        public int $totalTransactions,
        public int $totalWeight,
        public int $subsidyCount,
    ) {
    }
}
