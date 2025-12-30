<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

/**
 * Script Public Key - the locking script in a transaction output.
 *
 * Defines the conditions that must be satisfied to spend the output, typically requiring
 * a valid signature from the owner of the destination address.
 *
 * @see VOut
 */
readonly class ScriptPubKey
{
    /**
     * @param string $asm Assembly representation - human-readable form of the Bitcoin script (e.g., "OP_DUP OP_HASH160 ... OP_EQUALVERIFY OP_CHECKSIG").
     * @param string $hex Hexadecimal encoding - the raw bytes of the script in hex format.
     * @param string|null $address Bitcoin address - the destination address if this script represents a standard address type (null for non-standard scripts).
     * @param string $type Script type - the standard script template used (e.g., "pubkeyhash" for P2PKH, "scripthash" for P2SH, "witness_v0_keyhash" for native SegWit).
     */
    public function __construct(
        public string $asm,
        public string $hex,
        public ?string $address = null,
        public string $type = '',
    ) {
    }
}
