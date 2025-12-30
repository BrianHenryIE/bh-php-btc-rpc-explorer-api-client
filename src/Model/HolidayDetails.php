<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

use BrianHenryIE\BtcRpcExplorer\Endpoints\FunEndpoints;
use JsonMapper\Middleware\Attributes\MapFrom;

/**
 * Response model for Bitcoin holidays endpoints.
 *
 * @see FunEndpoints::holidays()
 * @see FunEndpoints::holidaysOn()
 * @see FunEndpoints::holidaysToday()
 */
readonly class HolidayDetails
{
    public function __construct(
        public string $name,
        public string $date,
        #[MapFrom('desc')]
        public string $description,
    ) {
    }
}
