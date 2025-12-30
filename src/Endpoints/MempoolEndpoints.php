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
     * Get the number of transactions in the mempool.
     */
    public function mempoolCount(): int
    {
        /** @var int */
        return $this->callApi('/mempool/count', 'int');
    }

    /**
     * Get the summary of Bitcoin Core's mempool / full output from 'getmempoolinfo'.
     */
    public function mempoolSummary(): MempoolSummary
    {
        /** @var MempoolSummary */
        return $this->callApi('/mempool/summary', MempoolSummary::class);
    }

    /**
     * Get recommended fees for various confirmation times.
     */
    public function mempoolFees(): Fees
    {
        /** @var Fees */
        return $this->callApi('/mempool/fees', Fees::class);
    }
}
