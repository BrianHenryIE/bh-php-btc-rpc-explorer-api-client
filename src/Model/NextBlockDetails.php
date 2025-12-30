<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

use JsonMapper\Middleware\Attributes\MapFrom;

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
        #[MapFrom('minFeeTxid')]
        public string $minFeeTxId,
        #[MapFrom('maxFeeTxid')]
        public string $maxFeeTxId,
        public float $totalFees,
    ) {
    }
}
