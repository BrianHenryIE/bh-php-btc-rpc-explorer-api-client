<?php

/**
 * Blocks
 *
 * /api/block/$HASH – Returns the details of the block with the given hash.
 * /api/block/$HEIGHT – Returns the details of the block at the given height.
 * /api/block/header/$HASH – Returns the details of the block header with the given hash.
 * /api/block/header/$HEIGHT – Returns the details of the block header at the given height.
 * /api/blocks/tip – Returns basic details about the chain tip.
 *
 * @package brianhenryie/bh-php-btc-rpc-explorer-api-client
 */

namespace BrianHenryIE\BtcRpcExplorer\Endpoints;

use BrianHenryIE\BtcRpcExplorer\Model\BlockDetails;
use BrianHenryIE\BtcRpcExplorer\Model\Tip;

trait BlocksEndpoints
{
    // Block endpoints

    /**
     * Get block details by hash.
     *
     * @param string $hash Block hash
     */
    public function blockWithHash(string $hash): BlockDetails
    {
        return $this->callApi("/block/{$hash}", BlockDetails::class);
    }

    /**
     * Get block details by height.
     *
     * @param int $height Block height
     */
    public function blockWithHeight(int $height): BlockDetails
    {
        return $this->callApi("/block/{$height}", BlockDetails::class);
    }

    /**
     * Get block header details by hash.
     *
     * @param string $hash Block hash
     */
    public function blockHeaderWithHash(string $hash): BlockDetails
    {
        return $this->callApi("/block/header/{$hash}", BlockDetails::class);
    }

    /**
     * Get block details by height.
     *
     * @param int $height Block height
     */
    public function blockHeaderWithHeight(int $height): BlockDetails
    {
        return $this->callApi("/block/header/{$height}", BlockDetails::class);
    }

    /**
     * Get the current tip height.
     */
    public function tip(): Tip
    {
        return $this->callApi('/blocks/tip', Tip::class);
    }

    /**
     * Get the current tip height.
     */
    public function tipHeight(): int
    {
        $response = $this->callApi('/blocks/tip/height', 'int');
        return (int) $response;
    }

    /**
     * Get the current tip hash.
     */
    public function tipHash(): string
    {
        return $this->callApi('/blocks/tip/hash', 'string');
    }
}
