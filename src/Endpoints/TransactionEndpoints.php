<?php

/**
 * Transaction endpoints
 *
 * /api/tx/$TXID – Returns the details of the transaction with the given txid.
 *
 * @package brianhenryie/bh-php-btc-rpc-explorer-api-client
 */

namespace BrianHenryIE\BtcRpcExplorer\Endpoints;

use BrianHenryIE\BtcRpcExplorer\Model\TXSummary;

trait TransactionEndpoints
{
    /**
     * Get transaction summary by transaction ID.
     *
     * @param string $txid Transaction ID
     */
    public function tx(string $txid): TXSummary
    {
        return $this->callApi("/tx/{$txid}", TXSummary::class);
    }
}
