<?php

/**
 * Fun endpoints
 *
 * /api/quotes/all – Returns the full curated list of Bitcoin quotes.
 * /api/quotes/$INDEX – Returns the Bitcoin quote with the given index from the curated list.
 * /api/quotes/random – Returns a random Bitcoin quote from the curated list.
 * /api/holidays/all – Returns the full curated list of Bitcoin Holidays.
 * /api/holidays/today – Returns the Bitcoin Holidays celebrated 'today' (i.e. at the time the API call is made). Optional parameters – tzOffsetThe number of hours to offset from UTC for the caller's local timezone, e.g. "-5" for EST
 * /api/holidays/$DAY – Returns the Bitcoin Holidays celebrated on the specified day, using one of the following formats: yyyy-MM-DD, MM-DD.
 *
 * @package brianhenryie/bh-php-btc-rpc-explorer-api-client
 */

namespace BrianHenryIE\BtcRpcExplorer\Endpoints;

use BrianHenryIE\BtcRpcExplorer\Model\HolidayDetails;
use BrianHenryIE\BtcRpcExplorer\Model\HolidaysDay;
use BrianHenryIE\BtcRpcExplorer\Model\QuoteDetails;

trait FunEndpoints
{
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

    /**
     * Returns the full curated list of Bitcoin Holidays.
     *
     * /api/holidays/all
     */
    public function holidays(): array
    {
        return $this->callApi('/holidays/all', HolidayDetails::class);
    }

    /**
     * Returns the Bitcoin Holidays celebrated 'today' (i.e. at the time the API call is made).
     *
     * /api/holidays/today
     *
     * @param int $tzOffset The number of hours to offset from UTC for the caller's local timezone, e.g. "-5" for EST.
     */
    public function holidaysToday(int $tzOffset = 0): HolidaysDay
    {
        return $this->callApi("/holidays/today?tzOffset={$tzOffset}", HolidaysDay::class);
    }

    /**
     * Returns the Bitcoin Holidays celebrated on the specified day, using one of the following formats: yyyy-MM-DD, MM-DD.
     *
     * /api/holidays/$DAY
     */
    public function holidaysOn(string $day): HolidaysDay
    {
//        TODO: validate input.

        return $this->callApi("/holidays/{$day}", HolidaysDay::class);
    }
}
