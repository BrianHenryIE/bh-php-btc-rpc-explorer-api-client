<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

use JsonMapper\Middleware\Attributes\MapFrom;

/**
 * Transaction input - part of CoinbaseTx and TXSummary.
 *
 * @see CoinbaseTx
 * @see TXSummary
 */
readonly class VIn
{
    /**
     * @param string[] $txinwitness
     */
    public function __construct(
        public ?string $coinbase = null,
        public array $txinwitness = [],
        public int $sequence = 0,
        #[MapFrom('txid')]
        public ?string $txId = null,
        public ?int $vout = null,
        public ?ScriptSig $scriptSig = null,
    ) {
    }
}
