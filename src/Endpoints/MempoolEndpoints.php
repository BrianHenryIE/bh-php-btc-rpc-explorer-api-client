<?php

namespace BrianHenryIE\BtcRpcExplorer\Endpoints;

use BrianHenryIE\BtcRpcExplorer\Model\Fees;

trait MempoolEndpoints
{
    // Mempool endpoints

    /**
     * Get the number of transactions in the mempool.
     */
    public function mempoolCount(): int
    {
        $response = $this->callApi('/mempool/count', 'int');
        return (int) $response;
    }

    /**
     * Get recommended fees for various confirmation times.
     */
    public function fees(): Fees
    {
        return $this->callApi('/mempool/fees', Fees::class);
    }
}
