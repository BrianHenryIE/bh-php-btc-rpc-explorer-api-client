<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

use JsonMapper\Middleware\Attributes\MapFrom;

/**
 * Part of BlockDetails response.
 *
 * @see BlockDetails
 */
readonly class CoinbaseTx
{
    /**
     * @param VIn[] $vIn
     * @param VOut[] $vOut
     */
    public function __construct(
        public bool $inActiveChain,
        #[MapFrom('txid')]
        public string $txId,
        public string $hash,
        public int $version,
        public int $size,
        #[MapFrom('vsize')]
        public int $vSize,
        public int $weight,
        #[MapFrom('locktime')]
        public int $lockTime,
        #[MapFrom('vin')]
        public array $vIn,
        #[MapFrom('vout')]
        public array $vOut,
        public string $hex,
        #[MapFrom('blockhash')]
        public string $blockHash,
        public int $confirmations,
        public int $time,
        #[MapFrom('blocktime')]
        public int $blockTime,
    ) {
    }
}
