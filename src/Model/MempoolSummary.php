<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

use BrianHenryIE\BtcRpcExplorer\Endpoints\MempoolEndpoints;
use JsonMapper\Middleware\Attributes\MapFrom;

/**
 * @see MempoolEndpoints::mempoolSummary()
 */
readonly class MempoolSummary
{
    public function __construct(
        public bool $loaded,
        public int $size,
        public int $bytes,
        public int $usage,
        public int $totalFee,
        #[MapFrom('maxmempool')]
        public int $maxMempool,
        #[MapFrom('mempoolminfee')]
        public string $mempoolMinFee,
        #[MapFrom('minrelaytxfee')]
        public string $minRelayTxFee,
        #[MapFrom('incrementalrelayfee')]
        public string $incrementalRelayFee,
        #[MapFrom('unbroadcastcount')]
        public int $unbroadcastCount,
        #[MapFrom('fullrbf')]
        public bool $fullReplaceByFee,
    ) {
    }
}
