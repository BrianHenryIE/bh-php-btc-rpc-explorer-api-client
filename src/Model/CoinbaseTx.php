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
     * @param VIn[] $vin
     * @param VOut[] $vout
     */
    public function __construct(
        public bool $inActiveChain,
        #[MapFrom('txid')]
        public string $txId,
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
        public int $time,
        public int $blocktime,
    ) {
    }
}
