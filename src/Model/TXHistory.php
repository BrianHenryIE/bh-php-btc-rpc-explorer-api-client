<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

use JsonMapper\Middleware\Attributes\MapFrom;

/**
 * Part of AddressSummary response.
 *
 * @see AddressSummary
 */
readonly class TXHistory
{
    /**
     * @param string[] $txIds
     * @param array<string, int> $blockHeightsByTxId
     */
    public function __construct(
        public int $txCount,
        #[MapFrom('txids')]
        public array $txIds,
        #[MapFrom('blockHeightsByTxid')]
        public array $blockHeightsByTxId,
        public int $balanceSat,
        public TXHistoryRequest $request,
    ) {
    }
}
