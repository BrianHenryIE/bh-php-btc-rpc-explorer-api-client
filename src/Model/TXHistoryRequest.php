<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

/**
 * Part of TXHistory response.
 *
 * @see TXHistory
 */
readonly class TXHistoryRequest
{
    public function __construct(
        public int $limit,
        public int $offset,
        public string $sort,
    ) {
    }
}
