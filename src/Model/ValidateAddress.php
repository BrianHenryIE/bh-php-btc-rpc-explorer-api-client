<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

/**
 * Part of AddressSummary response.
 *
 * @see AddressSummary
 */
readonly class ValidateAddress
{
    public function __construct(
        public bool $isvalid,
        public string $address,
        public string $scriptPubKey,
        public bool $isscript,
        public bool $iswitness,
    ) {
    }
}
