<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

/**
 * Response model for extended public key endpoints.
 *
 * @see \BrianHenryIE\BtcRpcExplorer\BtcRpcExplorerAPI::extendedPublicKeyDetails()
 */
readonly class ExtendedPublicKeyDetails
{
    /**
     * @param RelatedKey[] $relatedKeys
     * @param string[] $receiveAddresses
     * @param string[] $changeAddresses
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
