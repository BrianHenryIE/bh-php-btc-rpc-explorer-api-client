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
     * Get transaction details by transaction ID.
     *
     * Retrieves complete information about a Bitcoin transaction including inputs (coins being spent),
     * outputs (coins being sent), fees, and confirmation status. Each transaction has a unique txid
     * (transaction ID) that serves as its permanent identifier.
     *
     * @param string $txid Transaction ID (txid) - unique 64-character hexadecimal identifier for the transaction
     * @return TXSummary Complete transaction details including inputs, outputs, fees, block information, and confirmations
     */
    public function tx(string $txid): TXSummary
    {
        /** @var TXSummary */
        return $this->callApi("/tx/{$txid}", TXSummary::class);
    }
}
