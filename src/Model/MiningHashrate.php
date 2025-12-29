<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

use JsonMapper\Middleware\Attributes\MapFrom;

/**
 * Response model for hashrate endpoint.
 *
 * @see \BrianHenryIE\BtcRpcExplorer\BtcRpcExplorerAPI::hashrate()
 */
readonly class MiningHashrate
{
    public function __construct(
        #[MapFrom('1Day')]
        public HashrateSummary $oneDay,
        #[MapFrom('7Day')]
        public HashrateSummary $sevenDay,
        #[MapFrom('30Day')]
        public HashrateSummary $thirtyDay,
        #[MapFrom('90Day')]
        public HashrateSummary $ninetyDay,
        #[MapFrom('365Day')]
        public HashrateSummary $oneYear,
    ) {
    }
}
