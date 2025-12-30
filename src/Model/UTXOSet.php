<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

use DateTimeInterface;
use JsonMapper\Middleware\Attributes\MapFrom;
use RuntimeException;

/**
 * UTXO Set - statistics about all unspent transaction outputs.
 *
 * The UTXO (Unspent Transaction Output) set represents all spendable bitcoin in the network.
 * Each UTXO is a previous transaction output that hasn't been spent yet.
 *
 * @see \BrianHenryIE\BtcRpcExplorer\BtcRpcExplorerAPI::utxoSet()
 */
readonly class UTXOSet
{
    /**
     * @param int $height Block height - the blockchain height at which this UTXO set snapshot was taken.
     * @param string $bestBlock Best block hash - hash of the most recent block included in this snapshot.
     * @param int $txOuts UTXO count - total number of unspent transaction outputs in the set.
     * @param int $bogosize Estimated size - approximate serialized size of the UTXO set in bytes (for estimation only).
     * @param string $hashSerialized3 Serialized hash - hash of the serialized UTXO set (version 3), used to verify consistency.
     * @param string $totalAmount Total supply - sum of all unspent bitcoin in the UTXO set (in BTC).
     * @param int $transactions Transaction count - number of transactions that have at least one unspent output.
     * @param int $diskSize Disk size - actual size on disk of the UTXO set database in bytes.
     * @param bool $usingCoinStatsIndex Using coinstats index - whether Bitcoin Core's coinstats index is being used for faster UTXO queries.
     * @param int $lastUpdated Last updated - Unix timestamp when this UTXO set snapshot was last updated.
     */
    public function __construct(
        public int $height,
        #[MapFrom('bestblock')]
        public string $bestBlock,
        #[MapFrom('txouts')]
        public int $txOuts,
        public int $bogosize,
        #[MapFrom('hash_serialized_3')]
        public string $hashSerialized3,
        #[MapFrom('total_amount')]
        public string $totalAmount,
        public int $transactions,
        #[MapFrom('disk_size')]
        public int $diskSize,
        public bool $usingCoinStatsIndex,
        public int $lastUpdated,
    ) {
    }

    /**
     * Parse the Unix lastUpdated timestamp to DateTimeInterface.
     *
     * Converts the last updated timestamp to a DateTimeImmutable object for easier date manipulation.
     *
     * @return DateTimeInterface The last updated time as a DateTimeImmutable object.
     * @throws RuntimeException If the timestamp cannot be parsed.
     */
    public function getLastUpdated(): DateTimeInterface
    {
        $result = \DateTimeImmutable::createFromFormat('U', (string) $this->lastUpdated);
        if ($result === false) {
            throw new RuntimeException('Failed to parse last updated timestamp');
        }
        return $result;
    }
}
