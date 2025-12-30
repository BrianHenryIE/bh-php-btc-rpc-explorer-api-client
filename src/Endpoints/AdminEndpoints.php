<?php

/**
 * Admin endpoints
 *
 * /api/version – Returns the semantic version of the public API, which is maintained separate from the app version.
 *
 * @package brianhenryie/bh-php-btc-rpc-explorer-api-client
 */

namespace BrianHenryIE\BtcRpcExplorer\Endpoints;

trait AdminEndpoints
{
    /**
     * Get the BTC RPC Explorer API version (semver string).
     */
    public function version(): string
    {
        return trim($this->callApi('/version', 'string'));
    }
}
