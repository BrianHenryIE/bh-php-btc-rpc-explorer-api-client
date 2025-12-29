<?php

namespace BrianHenryIE\BtcRpcExplorer\Endpoints;

use BrianHenryIE\BtcRpcExplorer\Model\TXSummary;

trait TransactionEndpoints
{
    // Transaction endpoints

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
