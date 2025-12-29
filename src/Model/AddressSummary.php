<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

use JsonMapper\Middleware\Attributes\MapFrom;

/**
 * Response model for address summary endpoint.
 *
 * @see \BrianHenryIE\BtcRpcExplorer\BtcRpcExplorerAPI::addressSummary()
 */
readonly class AddressSummary
{
    public function __construct(
        public Base58 $base58,
        public string $encoding,
        #[MapFrom('validateaddress')]
        public ValidateAddress $validateAddress,
        #[MapFrom('electrumScripthash')]
        public string $electrumScriptHash,
        public TXHistory $txHistory,
    ) {
    }
}
