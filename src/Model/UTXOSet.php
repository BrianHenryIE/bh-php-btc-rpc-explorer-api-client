<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

use JsonMapper\Middleware\Attributes\MapFrom;

/**
 * Response model for UTXO set endpoint.
 *
 * @see \BrianHenryIE\BtcRpcExplorer\BtcRpcExplorerAPI::utxoSet()
 */
readonly class UTXOSet
{
    public function __construct(
        public int $height,
        #[MapFrom('bestblock')]
        public string $bestBlock,
        #[MapFrom('txouts')]
        public int $txOuts,
        public int $bogosize,
        #[MapFrom('hash_serialized_3')]
        public string $hashSerialized3,
        #[MapFrom('total_amount')]
        public string $totalAmount,
        public int $transactions,
        #[MapFrom('disk_size')]
        public int $diskSize,
        public bool $usingCoinStatsIndex,
        public int $lastUpdated,
    ) {
    }
}
