<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

/**
 * Response model for next block endpoint.
 *
 * @see \BrianHenryIE\BtcRpcExplorer\BtcRpcExplorerAPI::nextBlock()
 */
readonly class NextBlockDetails
{
    public function __construct(
        public int $txCount,
        public float $minFeeRate,
        public float $maxFeeRate,
        public string $minFeeTxid,
        public string $maxFeeTxid,
        public float $totalFees,
    ) {
    }
}
