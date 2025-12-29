<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

/**
 * Transaction output - part of CoinbaseTx and TXSummary.
 *
 * @see CoinbaseTx
 * @see TXSummary
 */
readonly class VOut
{
    public function __construct(
        public float $value,
        public int $n,
        public ScriptPubKey $scriptPubKey,
    ) {
    }
}
