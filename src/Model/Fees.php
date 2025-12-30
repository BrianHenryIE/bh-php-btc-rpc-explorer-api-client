<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

use JsonMapper\Middleware\Attributes\MapFrom;

/**
 * Recommended Fee Rates - suggested transaction fees for different confirmation times.
 *
 * Fee rates are measured in satoshis per virtual byte (sats/vB). Higher fees encourage
 * miners to include your transaction sooner in a block.
 *
 * @see \BrianHenryIE\BtcRpcExplorer\BtcRpcExplorerAPI::mempoolFees()
 */
readonly class Fees
{
    /**
     * @param int $nextBlock Next block fee rate - recommended fee in sats/vB for inclusion in the next mined block (typically ~10 minutes).
     * @param int $thirtyMinutes 30-minute fee rate - recommended fee in sats/vB for confirmation within approximately 30 minutes (~3 blocks).
     * @param int $sixtyMinutes 60-minute fee rate - recommended fee in sats/vB for confirmation within approximately 1 hour (~6 blocks).
     * @param int $oneDay 1-day fee rate - recommended fee in sats/vB for confirmation within approximately 1 day (~144 blocks).
     */
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
