<?php

namespace BrianHenryIE\BtcRpcExplorer\Endpoints;

use BrianHenryIE\BtcRpcExplorer\Model\ExtendedPublicKeyDetails;

trait UtilEndpoints
{
    // Util endpoints

    /**
     * Get details for an extended public key with default limit and offset.
     *
     * @param string $pubkey Extended public key
     */
    public function extendedPublicKeyDetails(string $pubkey): ExtendedPublicKeyDetails
    {
        return $this->extendedPublicKeyDetailsPage($pubkey, 20, 0);
    }

    /**
     * Get details for an extended public key with pagination.
     *
     * @param string $pubkey Extended public key
     * @param int $limit Number of results
     * @param int $offset Offset for pagination
     */
    public function extendedPublicKeyDetailsPage(string $pubkey, int $limit, int $offset): ExtendedPublicKeyDetails
    {
        $options = "";
        if ($offset !== 0 || $limit !== 0) {
            $options = "?limit={$limit}&offset={$offset}";
        }
        return $this->callApi("/util/xyzpub/{$pubkey}{$options}", ExtendedPublicKeyDetails::class);
    }
}
