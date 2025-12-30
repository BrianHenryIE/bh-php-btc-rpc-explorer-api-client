<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

use DateTimeImmutable;
use DateTimeInterface;
use JsonMapper\Middleware\Attributes\MapFrom;

/**
 * Response model for transaction endpoint.
 *
 * @see \BrianHenryIE\BtcRpcExplorer\BtcRpcExplorerAPI::tx()
 */
readonly class TXSummary
{
    /**
     * @param VIn[] $vin
     * @param VOut[] $vout
     */
    public function __construct(
        #[MapFrom('txid')]
        public string $txId,
        public string $hash,
        public int $version,
        public int $size,
        public int $vsize,
        public int $weight,
        public int $locktime,
        public array $vin,
        public array $vout,
        public string $hex,
        public string $blockhash,
        public int $confirmations,
        public int $blocktime,
    ) {
    }

    /**
     * Parse the unix `blocktime` to `DateTime`.
     */
    public function getBlockTime(): DateTimeInterface
    {
        return DateTimeImmutable::createFromFormat('U', $this->blocktime);
    }
}
