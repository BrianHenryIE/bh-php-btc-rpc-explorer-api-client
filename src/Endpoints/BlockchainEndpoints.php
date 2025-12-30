<?php

/**
 * Blockchain endpoints.
 *
 * /api/blockchain/coins – Returns the current supply of Bitcoin. An estimate using a checkpoint can be returned in 2 cases: on 'slow' devices, and before the UTXO Set snapshot is loaded.
 * /api/blockchain/utxo-set – Returns the latest UTXO Set snapshot. Warning: This call can be very slow, depending on node hardware and index configurations.
 * /api/blockchain/next-halving – Returns details about the next, upcoming halving.
 *
 * @package brianhenryie/bh-php-btc-rpc-explorer-api-client
 */

namespace BrianHenryIE\BtcRpcExplorer\Endpoints;

use BrianHenryIE\BtcRpcExplorer\Model\UTXOSet;

trait BlockchainEndpoints
{
    /**
     * Get the current supply of Bitcoin.
     *
     * @return float
     */
    public function coins(): float
    {
        /** @var float */
        return $this->callApi('/blockchain/coins', 'float');
    }

    /**
     * Get the current UTXO set snapshot.
     *
     * Unspent Transaction Output
     */
    public function utxoSet(): UTXOSet
    {
        /** @var UTXOSet */
        return $this->callApi('/blockchain/utxo-set', UTXOSet::class);
    }
}
