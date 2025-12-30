<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

/**
 * Part of MinerDetails response.
 *
 * @see MinerDetails
 */
readonly class MinerInfo
{
    public function __construct(
        public string $name,
        public ?string $type,
        public ?string $link,
        public string $identifiedBy,
    ) {
    }
}
