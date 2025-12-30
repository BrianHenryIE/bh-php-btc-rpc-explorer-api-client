<?php

/**
 * Xpubs endpoints
 *
 * /api/xyzpub/$XPUB – Returns details for the specified extended public key, including related keys and addresses.
 * /api/xyzpub/addresses/$XPUB – Returns a list of addresses derived from the given [xyz]pub.
 * /api/xyzpub/txids/$XPUB – Returns a list of transaction IDs associated with the given [xyz]pub.
 *
 * @package brianhenryie/bh-php-btc-rpc-explorer-api-client
 */

namespace BrianHenryIE\BtcRpcExplorer\Endpoints;

use BrianHenryIE\BtcRpcExplorer\Model\ExtendedPublicKeyDetails;
use BrianHenryIE\BtcRpcExplorer\Model\ExtendedPublicKeyTransactions;
use BrianHenryIE\BtcRpcExplorer\Model\ReceiveOrChange;

trait XpubsEndpoints
{
    /**
     * Get details for an extended public key with pagination.
     *
     * @param string $pubkey Extended public key
     * @param int $limit Number of results
     * @param int $offset Offset for pagination
     */
    public function extendedPublicKeyDetails(string $pubkey, int $limit = 0, int $offset = 0): ExtendedPublicKeyDetails
    {
        $options = "";
        if ($offset !== 0 || $limit !== 0) {
            $options = "?limit={$limit}&offset={$offset}";
        }
        /** @var ExtendedPublicKeyDetails */
        return $this->callApi("/xyzpub/{$pubkey}{$options}", ExtendedPublicKeyDetails::class);
    }

    /**
     * Returns a list of addresses derived from the given [xyz]pub.
     *
     * @param string $pubkey
     * @param ReceiveOrChange $receiveOrChange
     * @param int $limit
     * @param int $offset
     *
     * @return string[]
     */
    public function extendedPublicKeyAddresses(
        string $pubkey,
        ReceiveOrChange $receiveOrChange = ReceiveOrChange::RECEIVE,
        int $limit = 0,
        int $offset = 0
    ): array {
        $options = "?receiveOrChange={$receiveOrChange->value}";
        if ($offset !== 0 || $limit !== 0) {
            $options = "&limit={$limit}&offset={$offset}";
        }
        /** @var array<mixed> */
        return $this->callApi("/xyzpub/addresses/{$pubkey}{$options}", 'array');
    }

    /**
     * Returns a list of transaction IDs associated with the given [xyz]pub.
     *
     * @param string $pubkey
     */
    public function extendedPublicKeyTransactions(
        string $pubkey,
        int $gapLimit = 20,
        int $addressLimit = 0
    ): ExtendedPublicKeyTransactions {
        $options = "?";
        if ($gapLimit !== 20) {
            $options = "gapLimit={$gapLimit}&";
        }
        if ($addressLimit !== 0) {
            $options = "addressLimit={$addressLimit}&";
        }
        /** @var ExtendedPublicKeyTransactions */
        return $this->callApi("/xyzpub/txids/{$pubkey}{$options}", ExtendedPublicKeyTransactions::class);
    }
}
