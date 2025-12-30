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
     * Get details for an extended public key (xpub/ypub/zpub).
     *
     * Extended public keys (defined in BIP32) allow deriving multiple Bitcoin addresses from a single key.
     * This is useful for wallets that generate new addresses for each transaction while using one backup.
     * - xpub: Legacy addresses (P2PKH, start with '1')
     * - ypub: SegWit-wrapped addresses (P2SH-P2WPKH, start with '3')
     * - zpub: Native SegWit addresses (Bech32, start with 'bc1')
     *
     * @param string $pubkey Extended public key - an xpub, ypub, or zpub string
     * @param int $limit Number of addresses to return (0 = all)
     * @param int $offset Skip this many addresses for pagination
     * @return ExtendedPublicKeyDetails Details including key type, derived addresses, and related keys in other formats
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
     * Get addresses derived from an extended public key.
     *
     * Extended public keys can derive two chains of addresses:
     * - Receive addresses (m/0): Used for receiving payments from others
     * - Change addresses (m/1): Used for receiving change from your own transactions
     *
     * @param string $pubkey Extended public key (xpub/ypub/zpub)
     * @param ReceiveOrChange $receiveOrChange Which address chain to retrieve (RECEIVE or CHANGE)
     * @param int $limit Number of addresses to return (0 = all)
     * @param int $offset Skip this many addresses for pagination
     * @return string[] Array of Bitcoin addresses derived from the extended public key
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
     * Get transaction IDs associated with an extended public key.
     *
     * Returns all transactions involving addresses derived from this extended public key.
     * Uses the gap limit to determine how many unused addresses to scan.
     *
     * @param string $pubkey Extended public key (xpub/ypub/zpub)
     * @param int $gapLimit How many consecutive unused addresses to scan before stopping (default: 20, per BIP44)
     * @param int $addressLimit Maximum number of addresses to scan (0 = unlimited)
     * @return ExtendedPublicKeyTransactions Transaction IDs and count for this extended public key
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
