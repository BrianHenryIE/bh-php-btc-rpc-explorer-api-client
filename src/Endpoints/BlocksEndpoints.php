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
    /**
     * Get block details by hash.
     *
     * Retrieves comprehensive information about a specific block using its unique hash identifier.
     * Block hashes are 64-character hexadecimal strings that uniquely identify blocks.
     *
     * @param string $hash Block hash - 64-character hex identifier (e.g., "00000000000000000002a7c4c1e48d76c5a37902165a270156b7a8d72728a054")
     * @return BlockDetails Complete block information including transactions, timestamps, and mining details.
     */
    public function blockWithHash(string $hash): BlockDetails
    {
        /** @var BlockDetails */
        return $this->callApi("/block/{$hash}", BlockDetails::class);
    }

    /**
     * Get block details by height.
     *
     * Retrieves comprehensive information about a block at a specific position in the blockchain.
     * Block height is the number of blocks that came before it (genesis block = height 0).
     *
     * @param int $height Block height - the sequential position in the blockchain (e.g., 700000 for the 700,000th block)
     * @return BlockDetails Complete block information including transactions, timestamps, and mining details.
     */
    public function blockWithHeight(int $height): BlockDetails
    {
        /** @var BlockDetails */
        return $this->callApi("/block/{$height}", BlockDetails::class);
    }

    /**
     * Get block header details by hash.
     *
     * Retrieves just the block header (metadata without full transaction details) using the block's hash.
     * Headers are smaller and faster to retrieve than full blocks.
     *
     * @param string $hash Block hash - 64-character hex identifier
     * @return BlockDetails Block header information (metadata only, transaction list may be abbreviated).
     */
    public function blockHeaderWithHash(string $hash): BlockDetails
    {
        /** @var BlockDetails */
        return $this->callApi("/block/header/{$hash}", BlockDetails::class);
    }

    /**
     * Get block header details by height.
     *
     * Retrieves just the block header (metadata without full transaction details) for a block at a specific height.
     * Headers are smaller and faster to retrieve than full blocks.
     *
     * @param int $height Block height - the sequential position in the blockchain
     * @return BlockDetails Block header information (metadata only, transaction list may be abbreviated).
     */
    public function blockHeaderWithHeight(int $height): BlockDetails
    {
        /** @var BlockDetails */
        return $this->callApi("/block/header/{$height}", BlockDetails::class);
    }

    /**
     * Get the current blockchain tip.
     *
     * Returns information about the most recent block added to the blockchain (the "tip").
     * This represents the current state of the blockchain.
     *
     * @return Tip Basic information about the most recent block (height and hash).
     */
    public function tip(): Tip
    {
        /** @var Tip */
        return $this->callApi('/blocks/tip', Tip::class);
    }

    /**
     * Get the current blockchain tip height.
     *
     * Returns just the height (block number) of the most recent block in the blockchain.
     * This indicates how many blocks have been mined since the genesis block.
     *
     * @return int Current blockchain height (e.g., 800000 means 800,000 blocks have been mined).
     */
    public function tipHeight(): int
    {
        /** @var int */
        return $this->callApi('/blocks/tip/height', 'int');
    }

    /**
     * Get the current blockchain tip hash.
     *
     * Returns just the hash of the most recent block in the blockchain.
     * Useful for quickly checking if new blocks have been added.
     *
     * @return string 64-character hexadecimal hash of the most recent block.
     */
    public function tipHash(): string
    {
        /** @var string */
        return $this->callApi('/blocks/tip/hash', 'string');
    }
}
