<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

/**
 * Address Validation - Bitcoin Core's validation result for an address.
 *
 * Contains information about whether an address is valid and what type of
 * Bitcoin address it represents (legacy, script, witness/SegWit).
 *
 * @see AddressSummary
 */
readonly class ValidateAddress
{
    /**
     * @param bool $isvalid Is valid - whether this is a valid Bitcoin address that can receive payments.
     * @param string $address Bitcoin address - the address string that was validated.
     * @param string $scriptPubKey Script public key - the locking script in hexadecimal that corresponds to this address.
     * @param bool $isscript Is script address - whether this is a P2SH (Pay-to-Script-Hash) address starting with '3'.
     * @param bool $iswitness Is witness address - whether this is a SegWit address (native bech32 starting with 'bc1' or wrapped P2SH-P2WPKH).
     */
    public function __construct(
        public bool $isvalid,
        public string $address,
        public string $scriptPubKey,
        public bool $isscript,
        public bool $iswitness,
    ) {
    }
}
