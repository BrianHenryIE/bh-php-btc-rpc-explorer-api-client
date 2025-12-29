<?php

namespace BrianHenryIE\BtcRpcExplorer\Endpoints;

trait AdminEndpoints
{
    // Admin endpoints

    /**
     * Get the BTC RPC Explorer version.
     */
    public function version(): string
    {
        return $this->callApi('/version', 'string');
    }
}
