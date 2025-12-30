<?php

/**
 * Mining endpoints
 *
 * /api/mining/hashrate – Returns the network hash rate, estimated over the last 1, 7, 30, 90, and 365 days.
 * /api/mining/diff-adj-estimate – Returns the current estimate for the next difficulty adjustment as a percentage.
 * /api/mining/next-block – Returns a summary for the estimated next block to be mined (produced via getblocktemplate).
 * /api/mining/next-block/txids – Returns a list of the transaction IDs included in the estimated next block to be mined (produced via getblocktemplate).
 * /api/mining/next-block/includes/$TXID – Returns whether the specified transaction ID is included in the estimated next block to be mined (produced via getblocktemplate).
 * /api/mining/miner-summary – Returns whether the specified transaction ID is included in the estimated next block to be mined (produced via getblocktemplate).
 *
 * @package brianhenryie/bh-php-btc-rpc-explorer-api-client
 */

namespace BrianHenryIE\BtcRpcExplorer\Endpoints;

use BrianHenryIE\BtcRpcExplorer\Model\MinerSummary;
use BrianHenryIE\BtcRpcExplorer\Model\MiningHashrate;
use BrianHenryIE\BtcRpcExplorer\Model\NextBlockDetails;

trait MiningEndpoints
{
    /**
     * Get hashrate details for various time periods.
     */
    public function hashrate(): MiningHashrate
    {
        /** @var MiningHashrate */
        return $this->callApi('/mining/hashrate', MiningHashrate::class);
    }

    /**
     * Get difficulty adjustment estimate.
     */
    public function difficultyAdjustmentEstimate(): float
    {
        /** @var float */
        return $this->callApi('/mining/diff-adj-estimate', 'float');
    }

    /**
     * Get details about the next block.
     */
    public function nextBlock(): NextBlockDetails
    {
        /** @var NextBlockDetails */
        return $this->callApi('/mining/next-block', NextBlockDetails::class);
    }

    /**
     * Get transaction IDs that might be included in the next block.
     *
     * @return string[]
     */
    public function nextBlockTXIDs(): array
    {
        /** @var array<mixed> */
        return $this->callApi('/mining/next-block/txids', 'array');
    }

    /**
     * Check if a transaction is likely to be included in the next block.
     *
     * @param string $txid Transaction ID
     */
    public function nextBlockIncludes(string $txid): bool
    {
        /** @var array<mixed> $response */
        $response = $this->callApi("/mining/next-block/includes/{$txid}", 'array');
        return $response['included'] ?? false;
    }

    /**
     * Get miner summary since the specified period (e.g., "1d", "7d").
     *
     * @param string $since Time period (e.g., "1d", "7d", "30d")
     */
    public function minerSummary(string $since): MinerSummary
    {
        /** @var MinerSummary */
        return $this->callApi("/mining/miner-summary?since={$since}", MinerSummary::class);
    }
}
