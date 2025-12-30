<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

use JsonMapper\Middleware\Attributes\MapFrom;

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
     * @param bool $isValid Is valid - whether this is a valid Bitcoin address that can receive payments.
     * @param string $address Bitcoin address - the address string that was validated.
     * @param string $scriptPubKey Script public key - the locking script in hexadecimal that corresponds to this address.
     * @param bool $isScript Is script address - whether this is a P2SH (Pay-to-Script-Hash) address starting with '3'.
     * @param bool $isWitness Is witness address - whether this is a SegWit address (native bech32 starting with 'bc1' or wrapped P2SH-P2WPKH).
     */
    public function __construct(
        #[MapFrom('isvalid')]
        public bool $isValid,
        public string $address,
        public string $scriptPubKey,
        #[MapFrom('isscript')]
        public bool $isScript,
        #[MapFrom('iswitness')]
        public bool $isWitness,
    ) {
    }
}
