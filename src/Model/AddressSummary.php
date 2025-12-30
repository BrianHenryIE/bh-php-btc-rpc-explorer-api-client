<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

use JsonMapper\Middleware\Attributes\MapFrom;

/**
 * Address Summary - comprehensive information about a Bitcoin address.
 *
 * Provides details about an address including its encoding format, validation status,
 * and complete transaction history.
 *
 * @see \BrianHenryIE\BtcRpcExplorer\BtcRpcExplorerAPI::addressSummary()
 */
readonly class AddressSummary
{
    /**
     * @param Base58 $base58 Base58 encoding - the address represented in Base58 format (used for legacy and P2SH addresses).
     * @param string $encoding Address encoding - the format used to encode this address (e.g., "bech32" for native SegWit, "base58" for legacy).
     * @param ValidateAddress $validateAddress Address validation - results from Bitcoin Core's address validation including type and script information.
     * @param string $electrumScriptHash Electrum scripthash - the script hash used by Electrum wallets to query this address's history.
     * @param TXHistory $txHistory Transaction history - complete list of all transactions involving this address, including sent and received amounts.
     */
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
