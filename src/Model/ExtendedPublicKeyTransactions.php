<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

readonly class ExtendedPublicKeyTransactions
{
    /**
     * @param string[] $txids
     */
    public function __construct(
        public array $txids,
        public int $txCount,
    ) {
    }
}
