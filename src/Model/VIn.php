<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

use JsonMapper\Middleware\Attributes\MapFrom;

/**
 * Transaction Input (vIn) - represents coins being spent in a transaction.
 *
 * Each input references a previous transaction output (UTXO) that is being consumed.
 *
 * @see CoinbaseTx
 * @see TXSummary
 */
readonly class VIn
{
    /**
     * @param string|null $coinbase Coinbase data - arbitrary data included by miners in the first transaction of a block. Only present in coinbase transactions where new bitcoin is created.
     * @param string[] $txinwitness Transaction input witness - SegWit witness data containing signatures and public keys, stored separately from legacy transaction data.
     * @param int $sequence Sequence number - used for transaction replacement and relative timelocks. Value of 0xffffffff indicates finalized transaction.
     * @param string|null $txId Transaction ID (txid) - unique identifier of the transaction containing the output being spent. Null for coinbase transactions.
     * @param int|null $vOut Output index (vout) - the position of the output in the referenced transaction's output array. Null for coinbase transactions.
     * @param ScriptSig|null $scriptSig Script signature - the unlocking script providing data (signatures, public keys) to satisfy the scriptPubKey conditions of the output being spent.
     */
    public function __construct(
        public ?string $coinbase = null,
        public array $txinwitness = [],
        public int $sequence = 0,
        #[MapFrom('txid')]
        public ?string $txId = null,
        #[MapFrom('vout')]
        public ?int $vOut = null,
        public ?ScriptSig $scriptSig = null,
    ) {
    }
}
