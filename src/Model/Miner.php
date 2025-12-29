<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

/**
 * Part of CoinbaseTx response.
 *
 * @see CoinbaseTx
 */
readonly class Miner
{
    public function __construct(
        public string $name,
        public string $link,
        public string $identifiedBy,
    ) {
    }
}
