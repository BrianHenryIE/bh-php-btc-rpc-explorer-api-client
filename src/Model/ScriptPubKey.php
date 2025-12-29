<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

/**
 * Part of VOut response.
 *
 * @see VOut
 */
readonly class ScriptPubKey
{
    public function __construct(
        public string $asm,
        public string $hex,
        public ?string $address = null,
        public string $type = '',
    ) {
    }
}
