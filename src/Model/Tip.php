<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

use BrianHenryIE\BtcRpcExplorer\Endpoints\BlocksEndpoints;

/**
 * @see BlocksEndpoints::tip()
 */
readonly class Tip
{
    public function __construct(
        public int $height,
        public string $hash,
    ) {
    }
}
