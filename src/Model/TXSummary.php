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
     * @param VIn[] $vIn
     * @param VOut[] $vOut
     */
    public function __construct(
        #[MapFrom('txid')]
        public string $txId,
        public string $hash,
        public int $version,
        public int $size,
        #[MapFrom('vsize')]
        public int $vSize,
        public int $weight,
        #[MapFrom('locktime')]
        public int $lockTime,
        #[MapFrom('vin')]
        public array $vIn,
        #[MapFrom('vout')]
        public array $vOut,
        public string $hex,
        #[MapFrom('blockhash')]
        public string $blockHash,
        public int $confirmations,
        #[MapFrom('blocktime')]
        public int $blockTime,
    ) {
    }

    /**
     * Parse the unix `blockTime` to `DateTime`.
     */
    public function getBlockTime(): DateTimeInterface
    {
        $result = DateTimeImmutable::createFromFormat('U', (string) $this->blockTime);
        if ($result === false) {
            throw new \RuntimeException('Failed to parse block time');
        }
        return $result;
    }
}
