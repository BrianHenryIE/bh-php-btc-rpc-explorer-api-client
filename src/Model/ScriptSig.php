<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

/**
 * Script Signature - the unlocking script in a transaction input.
 *
 * Provides the data (typically signatures and public keys) needed to satisfy the
 * conditions specified in the scriptPubKey of the output being spent.
 *
 * @see VIn
 */
readonly class ScriptSig
{
    /**
     * @param string $asm Assembly representation - human-readable form of the unlocking script showing the signature and public key data.
     * @param string $hex Hexadecimal encoding - the raw bytes of the script in hex format.
     * @param int|null $sequence Sequence number - used for transaction replacement and timelocks (moved to VIn in newer Bitcoin Core versions).
     */
    public function __construct(
        public string $asm,
        public string $hex,
        public ?int $sequence = null,
    ) {
    }
}
