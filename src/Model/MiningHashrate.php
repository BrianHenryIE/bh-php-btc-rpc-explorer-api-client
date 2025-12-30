<?php

/**
 * TODO: NB, both "90day" and "30Day" seem valid, i.e. capitalisation. Consider CaseConversion.
 */

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
        #[MapFrom('90day')]
        public HashrateSummary $ninetyDay,
        #[MapFrom('365Day')]
        public HashrateSummary $oneYear,
    ) {
    }
}
