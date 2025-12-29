<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

/**
 * Response model for Bitcoin quotes endpoints.
 *
 * @see \BrianHenryIE\BtcRpcExplorer\BtcRpcExplorerAPI::quotes()
 * @see \BrianHenryIE\BtcRpcExplorer\BtcRpcExplorerAPI::quote()
 * @see \BrianHenryIE\BtcRpcExplorer\BtcRpcExplorerAPI::randomQuote()
 */
readonly class QuoteDetails
{
    public function __construct(
        public string $text,
        public string $speaker,
        public string $url,
        public string $date,
        public string $context,
    ) {
    }
}
