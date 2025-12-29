<?php

namespace BrianHenryIE\BtcRpcExplorer\Endpoints;

use BrianHenryIE\BtcRpcExplorer\Model\Fees;
use BrianHenryIE\BtcRpcExplorer\Model\MinerSummary;
use BrianHenryIE\BtcRpcExplorer\Model\MiningHashrate;
use BrianHenryIE\BtcRpcExplorer\Model\NextBlockDetails;
use BrianHenryIE\BtcRpcExplorer\Model\Price;
use BrianHenryIE\BtcRpcExplorer\Model\QuoteDetails;
use BrianHenryIE\BtcRpcExplorer\Model\TXSummary;
use BrianHenryIE\BtcRpcExplorer\Model\UTXOSet;
use BrianHenryIE\BtcRpcExplorer\Model\ExtendedPublicKeyDetails;

trait BlockchainEndpoints
{
    // Blockchain endpoints

    /**
     * Get the current supply of Bitcoin.
     *
     * @return float
     */
    public function coins(): float
    {
        $response = $this->callApi('/blockchain/coins', 'float');
        return (float) $response;
    }

    /**
     * Get the current UTXO set snapshot.
     *
     * @return UTXOSet
     */
    public function utxoSet(): UTXOSet
    {
        return $this->callApi('/blockchain/utxo-set', UTXOSet::class);
    }
}
