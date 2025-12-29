<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

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
        public ?string $txid = null,
        public ?int $vout = null,
        public ?ScriptSig $scriptSig = null,
    ) {
    }
}
