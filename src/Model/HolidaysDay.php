<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

use BrianHenryIE\BtcRpcExplorer\Endpoints\FunEndpoints;

/**
 * Response model for Bitcoin holidays endpoints.
 *
 * @see FunEndpoints::holidaysOn()
 * @see FunEndpoints::holidaysToday()
 */
readonly class HolidaysDay
{
    /**
     * @param HolidayDetails[] $holidays
     */
    public function __construct(
        public string $day,
        public array $holidays,
    ) {
    }
}
