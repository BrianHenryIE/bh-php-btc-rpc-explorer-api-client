<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

/**
 * Response model for UTXO set endpoint.
 *
 * @see \BrianHenryIE\BtcRpcExplorer\BtcRpcExplorerAPI::utxoSet()
 */
readonly class UTXOSet
{
    public function __construct(
        public int $height,
        public string $bestblock,
        public int $txouts,
        public int $bogosize,
        public string $hash_serialized_2,
        public string $total_amount,
        public int $transactions,
        public int $disk_size,
        public bool $usingCoinStatsIndex,
        public int $lastUpdated,
    ) {
    }
}
