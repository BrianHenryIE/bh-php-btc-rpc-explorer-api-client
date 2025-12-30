<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

use JsonMapper\Middleware\Attributes\MapFrom;

/**
 * Coinbase Transaction - the first transaction in a block that creates new bitcoin.
 *
 * The coinbase transaction is special - it has no inputs (it creates new bitcoin as miner reward)
 * and its input contains arbitrary data that miners can use for extra nonce space or messages.
 *
 * @see BlockDetails
 */
readonly class CoinbaseTx
{
    /**
     * @param bool $inActiveChain In active chain - whether this transaction is in the currently active blockchain.
     * @param string $txId Transaction ID (txid) - unique identifier for this coinbase transaction.
     * @param string $hash Transaction hash - includes witness data for SegWit, same as txid for legacy.
     * @param int $version Transaction version - protocol version number.
     * @param int $size Transaction size - total size in bytes including witness data.
     * @param int $vSize Virtual size (vsize) - size in virtual bytes for fee calculation.
     * @param int $weight Transaction weight - size metric where non-witness data counts 4x more.
     * @param int $lockTime Lock time - earliest time/block when transaction can be added to blockchain.
     * @param VIn[] $vIn Transaction inputs (vin) - for coinbase, contains arbitrary data instead of spending previous outputs.
     * @param VOut[] $vOut Transaction outputs (vout) - newly created bitcoin going to miner's address.
     * @param string $hex Raw transaction - complete transaction data in hexadecimal.
     * @param string $blockHash Block hash - unique identifier of the block containing this transaction.
     * @param int $confirmations Confirmation count - number of blocks built on top of this block.
     * @param int $time Transaction time - Unix timestamp when this transaction was created.
     * @param int $blockTime Block timestamp - Unix timestamp when the block was mined.
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
