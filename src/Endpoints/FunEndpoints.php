<?php

namespace BrianHenryIE\BtcRpcExplorer\Endpoints;

use BrianHenryIE\BtcRpcExplorer\Model\QuoteDetails;

trait FunEndpoints
{
    // Fun endpoints

    /**
     * Get all Bitcoin quotes.
     *
     * @return QuoteDetails[]
     */
    public function quotes(): array
    {
        return $this->callApi('/quotes/all', QuoteDetails::class);
    }

    /**
     * Get a specific quote by index.
     *
     * @param int $index Quote index
     */
    public function quote(int $index): QuoteDetails
    {
        return $this->callApi("/quotes/{$index}", QuoteDetails::class);
    }

    /**
     * Get a random Bitcoin quote.
     */
    public function randomQuote(): QuoteDetails
    {
        return $this->callApi('/quotes/random', QuoteDetails::class);
    }
}
