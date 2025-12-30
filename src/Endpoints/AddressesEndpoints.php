<?php

/**
 * Addresses endpoints
 *
 * /api/address/$ADDRESS – Returns a summary of data pertaining to the given address.
 *
 * "The output of this call will depend heavily on the configured 'Address API' (see .env-sample file). If an Address
 * API is configured, transactions related to the given address will be returned (the below optional parameters apply
 * to those transactions)."
 *
 * @package brianhenryie/bh-php-btc-rpc-explorer-api-client
 */

namespace BrianHenryIE\BtcRpcExplorer\Endpoints;

use BrianHenryIE\BtcRpcExplorer\Model\AddressSummary;

trait AddressesEndpoints
{
    /**
     * Get summary information for a Bitcoin address.
     *
     * @param string $address Bitcoin address
     */
    public function addressSummary(
        string $address,
        int $limit = 0,
        int $offset = 0,
        // TODO: sort desc|asc.
    ): AddressSummary {
        /** @var AddressSummary */
        return $this->callApi("/address/{$address}", AddressSummary::class);
    }
}
