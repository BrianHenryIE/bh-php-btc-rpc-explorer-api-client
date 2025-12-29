<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

/**
 * Response model for price endpoint.
 *
 * @see \BrianHenryIE\BtcRpcExplorer\BtcRpcExplorerAPI::price()
 */
readonly class Price
{
    public function __construct(
        public string $usd,
        public string $eur,
        public string $gbp,
        public string $xau,
    ) {
    }
}
