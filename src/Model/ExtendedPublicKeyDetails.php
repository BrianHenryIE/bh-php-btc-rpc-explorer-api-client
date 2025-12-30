<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

/**
 * Extended Public Key Details - information about an xpub/ypub/zpub and its derived addresses.
 *
 * Extended public keys (defined in BIP32) allow deriving multiple Bitcoin addresses from a single key.
 * Different key types (xpub/ypub/zpub) produce different address formats for compatibility.
 *
 * @see \BrianHenryIE\BtcRpcExplorer\BtcRpcExplorerAPI::extendedPublicKeyDetails()
 */
readonly class ExtendedPublicKeyDetails
{
    /**
     * @param string $keyType Key type - the extended public key prefix (xpub, ypub, or zpub).
     * @param string $outputType Output script type - the type of Bitcoin script this key produces (e.g., "p2pkh", "p2sh-p2wpkh", "p2wpkh").
     * @param string $outputTypeDesc Output type description - human-readable explanation of the address format (e.g., "Legacy", "SegWit wrapped", "Native SegWit").
     * @param string $bip32Path BIP32 derivation path - the hierarchical path used to derive this key (e.g., "m/44'/0'/0'").
     * @param RelatedKey[] $relatedKeys Related keys - equivalent extended public keys in other formats (xpub/ypub/zpub conversions).
     * @param string[] $receiveAddresses Receive addresses - Bitcoin addresses derived for receiving payments (typically from the m/0 path).
     * @param string[] $changeAddresses Change addresses - Bitcoin addresses derived for receiving change from transactions (typically from the m/1 path).
     */
    public function __construct(
        public string $keyType,
        public string $outputType,
        public string $outputTypeDesc,
        public string $bip32Path,
        public array $relatedKeys,
        public array $receiveAddresses,
        public array $changeAddresses,
    ) {
    }
}
