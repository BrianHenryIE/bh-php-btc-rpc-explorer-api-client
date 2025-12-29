<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

/**
 * Response model for miner summary endpoint.
 *
 * @see \BrianHenryIE\BtcRpcExplorer\BtcRpcExplorerAPI::minerSummary()
 */
readonly class MinerSummary
{
    /**
     * @param array<string, MinerDetails> $miners
     * @param string[] $minerNamesSortedByBlockCount
     */
    public function __construct(
        public array $miners,
        public array $minerNamesSortedByBlockCount,
        public OverallMiningStats $overall,
    ) {
    }
}
