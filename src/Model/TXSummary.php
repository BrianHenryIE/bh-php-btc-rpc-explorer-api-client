<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

use DateTimeImmutable;
use DateTimeInterface;
use JsonMapper\Middleware\Attributes\MapFrom;

/**
 * Transaction Summary - complete details of a Bitcoin transaction.
 *
 * Contains all information about a transaction including inputs (coins being spent),
 * outputs (coins being created/sent), and blockchain confirmation status.
 *
 * @see \BrianHenryIE\BtcRpcExplorer\BtcRpcExplorerAPI::tx()
 */
readonly class TXSummary
{
    /**
     * @param string $txId Transaction ID (txid) - unique 64-character hexadecimal identifier for this transaction.
     * @param string $hash Transaction hash - includes witness data for SegWit transactions, same as txid for legacy transactions.
     * @param int $version Transaction version - protocol version number (typically 1 or 2).
     * @param int $size Transaction size in bytes - total size including witness data.
     * @param int $vSize Virtual size (vsize) - size in virtual bytes, used for fee calculation with SegWit (witness data is discounted).
     * @param int $weight Transaction weight - size metric where non-witness data counts 4x more than witness data (vsize = weight/4).
     * @param int $lockTime Lock time - earliest time or block height when this transaction can be added to the blockchain (0 means no lock).
     * @param VIn[] $vIn Transaction inputs (vin) - array of inputs, each referencing a previous output (UTXO) being spent.
     * @param VOut[] $vOut Transaction outputs (vout) - array of outputs, each specifying an amount and destination conditions.
     * @param string $hex Raw transaction - the complete transaction data in hexadecimal format.
     * @param string $blockHash Block hash - unique identifier of the block containing this transaction.
     * @param int $confirmations Confirmation count - number of blocks built on top of the block containing this transaction (higher = more secure).
     * @param int $blockTime Block timestamp - Unix timestamp (seconds since Jan 1, 1970) when the block was mined.
     */
    public function __construct(
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
        #[MapFrom('blocktime')]
        public int $blockTime,
    ) {
    }

    /**
     * Parse the unix blockTime to DateTimeInterface.
     *
     * Converts the Unix timestamp to a DateTimeImmutable object for easier date manipulation.
     *
     * @return DateTimeInterface The block time as a DateTimeImmutable object.
     * @throws \RuntimeException If the timestamp cannot be parsed.
     */
    public function getBlockTime(): DateTimeInterface
    {
        $result = DateTimeImmutable::createFromFormat('U', (string) $this->blockTime);
        if ($result === false) {
            throw new \RuntimeException('Failed to parse block time');
        }
        return $result;
    }
}
