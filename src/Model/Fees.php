<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

use JsonMapper\Middleware\Attributes\MapFrom;

/**
 * Response model for mempool fees endpoint.
 *
 * @see \BrianHenryIE\BtcRpcExplorer\BtcRpcExplorerAPI::mempoolFees()
 */
readonly class Fees
{
    public function __construct(
        public int $nextBlock,
        #[MapFrom('30min')]
        public int $thirtyMinutes,
        #[MapFrom('60min')]
        public int $sixtyMinutes,
        #[MapFrom('1day')]
        public int $oneDay,
    ) {
    }
}
