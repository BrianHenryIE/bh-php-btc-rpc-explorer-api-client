<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

/**
 * Part of AddressSummary response.
 *
 * @see AddressSummary
 */
readonly class Base58
{
    public function __construct(
        public string $hash,
        public int $version,
    ) {
    }
}
