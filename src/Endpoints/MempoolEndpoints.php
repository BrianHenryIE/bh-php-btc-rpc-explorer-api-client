<?php

/**
 * Mempool endpoints
 *
 * /api/mempool/count – Returns the number of transactions in Bitcoin Core's mempool.
 * /api/mempool/summary – Returns a summary of Bitcoin Core's mempool (full output from 'getmempoolinfo')
 * /api/mempool/fees – Returns recommended fee rates in sats/vB for next block, ~30 min, 1 hr, and 1 day.
 *
 * @package brianhenryie/bh-php-btc-rpc-explorer-api-client
 */

namespace BrianHenryIE\BtcRpcExplorer\Endpoints;

use BrianHenryIE\BtcRpcExplorer\Model\Fees;
use BrianHenryIE\BtcRpcExplorer\Model\MempoolSummary;

trait MempoolEndpoints
{
    /**
     * Get the number of unconfirmed transactions in the mempool.
     *
     * The mempool (memory pool) holds transactions that have been broadcast to the network
     * but not yet included in a block. This returns how many transactions are waiting.
     *
     * @return int Number of transactions currently in the mempool waiting for confirmation
     */
    public function mempoolCount(): int
    {
        /** @var int */
        return $this->callApi('/mempool/count', 'int');
    }

    /**
     * Get detailed statistics about the mempool.
     *
     * Returns comprehensive information about unconfirmed transactions including size limits,
     * fee rates, and memory usage. The mempool acts as a waiting room for transactions
     * before miners include them in blocks.
     *
     * @return MempoolSummary Detailed mempool statistics including transaction count, memory usage, fee rates, and configuration
     */
    public function mempoolSummary(): MempoolSummary
    {
        /** @var MempoolSummary */
        return $this->callApi('/mempool/summary', MempoolSummary::class);
    }

    /**
     * Get recommended transaction fee rates for different confirmation times.
     *
     * Returns suggested fee rates (in satoshis per virtual byte) for transactions you want
     * confirmed within specific timeframes. Higher fees encourage miners to prioritize your
     * transaction. Fees are based on current network conditions and mempool congestion.
     *
     * @return Fees Recommended fee rates in sats/vB for next block (~10 min), 30 min, 1 hour, and 1 day confirmations
     */
    public function mempoolFees(): Fees
    {
        /** @var Fees */
        return $this->callApi('/mempool/fees', Fees::class);
    }
}
