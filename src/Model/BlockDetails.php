<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

/**
 * Response model for block endpoints.
 *
 * @see \BrianHenryIE\BtcRpcExplorer\BtcRpcExplorerAPI::blockWithHash()
 * @see \BrianHenryIE\BtcRpcExplorer\BtcRpcExplorerAPI::blockWithHeight()
 */
readonly class BlockDetails
{
    /**
     * @param string[] $tx
     */
    public function __construct(
        public string $hash,
        public int $confirmations,
        public int $Height,
        public int $version,
        public string $versionHex,
        public string $merkleroot,
        public int $time,
        public int $mediantime,
        public int $nonce,
        public string $bits,
        public string $difficulty,
        public string $chainwork,
        public int $nTx,
        public string $previousblockhash,
        public string $nextblockhash,
        public int $strippedsize,
        public int $size,
        public int $weight,
        public array $tx,
        public CoinbaseTx $coinbaseTx,
    ) {
    }
}
