<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

use JsonMapper\Middleware\Attributes\MapFrom;

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
        public int $height,
        public int $version,
        public string $versionHex,
        #[MapFrom('merkleroot')]
        public string $merkleRoot,
        public int $time,
        #[MapFrom('mediantime')]
        public int $medianTime,
        public int $nonce,
        public string $bits,
        public string $difficulty,
        #[MapFrom('chainwork')]
        public string $chainWork,
        public int $nTx,
        #[MapFrom('previousblockhash')]
        public string $previousBlockHash,
        #[MapFrom('nextblockhash')]
        public string $nextBlockHash,
        #[MapFrom('strippedsize')]
        public int $strippedSize,
        public int $size,
        public int $weight,
        public array $tx,
        public ?CoinbaseTx $coinbaseTx,
        public ?string $totalFees,
        public ?string $miner, // TODO: This is null in fixture, check true shape.
        public ?string $subsidy,
    ) {
    }
}
