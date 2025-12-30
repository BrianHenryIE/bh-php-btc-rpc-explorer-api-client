<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

use JsonMapper\Middleware\Attributes\MapFrom;

readonly class ExtendedPublicKeyTransactions
{
    /**
     * @param string[] $txIds
     */
    public function __construct(
        #[MapFrom('txids')]
        public array $txIds,
        public int $txCount,
    ) {
    }
}
