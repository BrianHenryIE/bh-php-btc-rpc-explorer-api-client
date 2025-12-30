<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

use BrianHenryIE\BtcRpcExplorer\Endpoints\MempoolEndpoints;
use JsonMapper\Middleware\Attributes\MapFrom;

/**
 * Mempool Summary - statistics about unconfirmed transactions waiting to be mined.
 *
 * The mempool (memory pool) holds transactions that have been broadcast to the network
 * but not yet included in a block. Miners select transactions from the mempool to include
 * in the next block, typically prioritizing those with higher fee rates.
 *
 * @see MempoolEndpoints::mempoolSummary()
 */
readonly class MempoolSummary
{
    /**
     * @param bool $loaded Mempool loaded - whether the mempool data has been fully loaded into memory.
     * @param int $size Transaction count - number of transactions currently in the mempool waiting for confirmation.
     * @param int $bytes Total bytes - combined size of all transactions in the mempool.
     * @param int $usage Memory usage - actual memory consumed by the mempool in bytes.
     * @param int $totalFee Total fees - sum of all transaction fees in the mempool (in satoshis).
     * @param int $maxMempool Maximum mempool size - configured limit for mempool memory usage in bytes.
     * @param string $mempoolMinFee Mempool minimum fee - minimum fee rate (in BTC/kB) required for a transaction to enter the mempool.
     * @param string $minRelayTxFee Minimum relay fee - minimum fee rate (in BTC/kB) for relaying transactions across the network.
     * @param string $incrementalRelayFee Incremental relay fee - minimum fee rate increase (in BTC/kB) required for Replace-By-Fee (RBF) transactions.
     * @param int $unbroadcastCount Unbroadcast count - number of transactions created locally but not yet broadcast to peers.
     * @param bool $fullReplaceByFee Full RBF enabled - whether full Replace-By-Fee is enabled, allowing any transaction to be replaced with a higher fee version.
     */
    public function __construct(
        public bool $loaded,
        public int $size,
        public int $bytes,
        public int $usage,
        public int $totalFee,
        #[MapFrom('maxmempool')]
        public int $maxMempool,
        #[MapFrom('mempoolminfee')]
        public string $mempoolMinFee,
        #[MapFrom('minrelaytxfee')]
        public string $minRelayTxFee,
        #[MapFrom('incrementalrelayfee')]
        public string $incrementalRelayFee,
        #[MapFrom('unbroadcastcount')]
        public int $unbroadcastCount,
        #[MapFrom('fullrbf')]
        public bool $fullReplaceByFee,
    ) {
    }
}
