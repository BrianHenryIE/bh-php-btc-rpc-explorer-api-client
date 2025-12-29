<?php

namespace BrianHenryIE\BtcRpcExplorer\Endpoints;

use BrianHenryIE\BtcRpcExplorer\Model\MinerSummary;
use BrianHenryIE\BtcRpcExplorer\Model\MiningHashrate;
use BrianHenryIE\BtcRpcExplorer\Model\NextBlockDetails;

trait MiningEndpoints
{
    // Mining endpoints

    /**
     * Get hashrate details for various time periods.
     */
    public function hashrate(): MiningHashrate
    {
        return $this->callApi('/mining/hashrate', MiningHashrate::class);
    }

    /**
     * Get difficulty adjustment estimate.
     */
    public function difficultyAdjustmentEstimate(): float
    {
        $response = $this->callApi('/mining/diff-adj-estimate', 'float');
        return (float) $response;
    }

    /**
     * Get details about the next block.
     */
    public function nextBlock(): NextBlockDetails
    {
        return $this->callApi('/mining/next-block', NextBlockDetails::class);
    }

    /**
     * Get transaction IDs that might be included in the next block.
     *
     * @return string[]
     */
    public function nextBlockTXIDs(): array
    {
        return $this->callApi('/mining/next-block/txids', 'array');
    }

    /**
     * Check if a transaction is likely to be included in the next block.
     *
     * @param string $txid Transaction ID
     */
    public function nextBlockIncludes(string $txid): bool
    {
        $response = $this->callApi("/mining/next-block/includes/{$txid}", 'array');
        return $response['included'] ?? false;
    }

    /**
     * Get miner summary since the specified period (e.g., "1d", "7d").
     *
     * @param string $since Time period (e.g., "1d", "7d", "30d")
     * @return MinerSummary
     */
    public function minerSummary(string $since): MinerSummary
    {
        return $this->callApi("/mining/miner-summary?since={$since}", MinerSummary::class);
    }
}
