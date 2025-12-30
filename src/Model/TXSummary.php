<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

/**
 * Response model for transaction endpoint.
 *
 * @see \BrianHenryIE\BtcRpcExplorer\BtcRpcExplorerAPI::tx()
 */
readonly class TXSummary
{
    /**
     * @param VIn[] $vin
     * @param VOut[] $vout
     */
    public function __construct(
        public string $txid,
        public string $hash,
        public int $version,
        public int $size,
        public int $vsize,
        public int $weight,
        public int $locktime,
        public array $vin,
        public array $vout,
        public string $hex,
        public string $blockhash,
        public int $confirmations,
        public int $blocktime,
    ) {
    }
}
