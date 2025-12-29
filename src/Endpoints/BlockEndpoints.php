<?php

namespace BrianHenryIE\BtcRpcExplorer\Endpoints;

use BrianHenryIE\BtcRpcExplorer\Model\BlockDetails;

trait BlockEndpoints
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
