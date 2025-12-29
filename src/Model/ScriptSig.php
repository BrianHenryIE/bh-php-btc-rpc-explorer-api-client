<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

/**
 * Part of VIn response.
 *
 * @see VIn
 */
readonly class ScriptSig
{
    public function __construct(
        public string $asm,
        public string $hex,
        public ?int $sequence = null,
    ) {
    }
}
