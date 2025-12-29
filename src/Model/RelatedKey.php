<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

/**
 * Part of ExtendedPublicKeyDetails response.
 *
 * @see ExtendedPublicKeyDetails
 */
readonly class RelatedKey
{
    public function __construct(
        public string $keyType,
        public string $key,
        public string $outputType,
        public string $firstAddress,
    ) {
    }
}
