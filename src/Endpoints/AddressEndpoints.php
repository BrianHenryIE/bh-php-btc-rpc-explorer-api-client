<?php

namespace BrianHenryIE\BtcRpcExplorer\Endpoints;

use BrianHenryIE\BtcRpcExplorer\Model\AddressSummary;

trait AddressEndpoints
{
    // Address endpoints

    /**
     * Get summary information for a Bitcoin address.
     *
     * @param string $address Bitcoin address
     */
    public function addressSummary(string $address): AddressSummary
    {
        return $this->callApi("/address/{$address}", AddressSummary::class);
    }
}
