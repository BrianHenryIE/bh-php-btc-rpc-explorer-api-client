<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

/**
 * Transaction Output (vOut) - represents coins being created or sent in a transaction.
 *
 * Each output specifies an amount of bitcoin and the conditions required to spend it.
 * Unspent outputs (UTXOs) can be used as inputs in future transactions.
 *
 * @see CoinbaseTx
 * @see TXSummary
 */
readonly class VOut
{
    /**
     * @param float $value Amount in BTC - the quantity of bitcoin assigned to this output (e.g., 0.5 BTC).
     * @param int $n Output index - the position of this output in the transaction's output array, used to reference it in future transaction inputs.
     * @param ScriptPubKey $scriptPubKey Script public key - the locking script that specifies the conditions (e.g., signature requirements) that must be satisfied to spend this output.
     */
    public function __construct(
        public float $value,
        public int $n,
        public ScriptPubKey $scriptPubKey,
    ) {
    }
}
