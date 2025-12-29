<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

/**
 * Part of MiningHashrate response.
 *
 * @see MiningHashrate
 */
readonly class HashrateSummary
{
    public function __construct(
        public float $val,
        public string $unit,
        public string $unitAbbreviation,
        public string $unitExponent,
        public string $unitMultiplier,
        public string $raw,
        public string $string1,
        public string $string2,
        public string $string3,
    ) {
    }
}
