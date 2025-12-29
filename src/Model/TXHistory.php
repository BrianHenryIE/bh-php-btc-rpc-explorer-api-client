<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

/**
 * Part of AddressSummary response.
 *
 * @see AddressSummary
 */
readonly class TXHistory
{
    /**
     * @param string[] $txids
     * @param array<string, int> $blockHeightsByTxid
     */
    public function __construct(
        public int $txCount,
        public array $txids,
        public array $blockHeightsByTxid,
        public int $balanceSat,
        public TXHistoryRequest $request,
    ) {
    }
}
