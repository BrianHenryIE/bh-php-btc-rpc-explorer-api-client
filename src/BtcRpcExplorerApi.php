<?php

/**
 * PHP wrapper for the BTC RPC Explorer API.
 *
 * BTC RPC Explorer is a self-hosted Bitcoin blockchain explorer.
 *
 * @see https://github.com/janoside/btc-rpc-explorer
 *
 * @package brianhenryie/bh-php-btc-rpc-explorer-api-client
 */

namespace BrianHenryIE\BtcRpcExplorer;

use BrianHenryIE\BtcRpcExplorer\Endpoints\AddressesEndpoints;
use BrianHenryIE\BtcRpcExplorer\Endpoints\AdminEndpoints;
use BrianHenryIE\BtcRpcExplorer\Endpoints\BlockchainEndpoints;
use BrianHenryIE\BtcRpcExplorer\Endpoints\BlocksEndpoints;
use BrianHenryIE\BtcRpcExplorer\Endpoints\FunEndpoints;
use BrianHenryIE\BtcRpcExplorer\Endpoints\MempoolEndpoints;
use BrianHenryIE\BtcRpcExplorer\Endpoints\MiningEndpoints;
use BrianHenryIE\BtcRpcExplorer\Endpoints\PriceEndpoints;
use BrianHenryIE\BtcRpcExplorer\Endpoints\TransactionEndpoints;
use BrianHenryIE\BtcRpcExplorer\Endpoints\XpubsEndpoints;

class BtcRpcExplorerApi extends AbstractApi
{
    /**
     * /api/address/$ADDRESS – Returns a summary of data pertaining to the given address.
     */
    use AddressesEndpoints;

    /**
     * /api/blockchain/coins – Returns the current supply of Bitcoin. An estimate using a checkpoint can be returned in 2 cases: on 'slow' devices, and before the UTXO Set snapshot is loaded.
     * /api/blockchain/utxo-set – Returns the latest UTXO Set snapshot. Warning: This call can be very slow, depending on node hardware and index configurations.
     * /api/blockchain/next-halving – Returns details about the next, upcoming halving.
     */
    use BlockchainEndpoints;

    /**
     * /api/block/$HASH – Returns the details of the block with the given hash.
     * /api/block/$HEIGHT – Returns the details of the block at the given height.
     * /api/block/header/$HASH – Returns the details of the block header with the given hash.
     * /api/block/header/$HEIGHT – Returns the details of the block header at the given height.
     * /api/blocks/tip – Returns basic details about the chain tip.
     */
    use BlocksEndpoints;

    /**
     * /api/tx/$TXID – Returns the details of the transaction with the given txid.
     */
    use TransactionEndpoints;

    /**
     * /api/mempool/count – Returns the number of transactions in Bitcoin Core's mempool.
     * /api/mempool/summary – Returns a summary of Bitcoin Core's mempool (full output from 'getmempoolinfo')
     * /api/mempool/fees – Returns recommended fee rates in sats/vB for next block, ~30 min, 1 hr, and 1 day.
     */
    use MempoolEndpoints;

    /**
     * /api/mining/hashrate – Returns the network hash rate, estimated over the last 1, 7, 30, 90, and 365 days.
     * /api/mining/diff-adj-estimate – Returns the current estimate for the next difficulty adjustment as a percentage.
     * /api/mining/next-block – Returns a summary for the estimated next block to be mined (produced via getblocktemplate).
     * /api/mining/next-block/txids – Returns a list of the transaction IDs included in the estimated next block to be mined (produced via getblocktemplate).
     * /api/mining/next-block/includes/$TXID – Returns whether the specified transaction ID is included in the estimated next block to be mined (produced via getblocktemplate).
     * /api/mining/miner-summary – Returns whether the specified transaction ID is included in the estimated next block to be mined (produced via getblocktemplate).
     */
    use MiningEndpoints;

    /**
     * /api/price – Returns the price of 1 BTC, in USD, EUR, GBP, and XAU
     * /api/price/marketcap – Returns the market cap of Bitcoin, in USD, EUR, GBP, XAU
     * /api/price/sats – Returns the price of 1 unit of [USD, EUR, GBP, XAU] (e.g. 1 "usd") in satoshis (aka "Moscow Time")
     */
    use PriceEndpoints;

    /**
     * /api/xyzpub/$XPUB – Returns details for the specified extended public key, including related keys and addresses.
     * /api/xyzpub/addresses/$XPUB – Returns a list of addresses derived from the given [xyz]pub.
     * /api/xyzpub/txids/$XPUB – Returns a list of transaction IDs associated with the given [xyz]pub.
     */
    use XpubsEndpoints;

    /**
     * /api/version – Returns the semantic version of the public API, which is maintained separate from the app version.
     */
    use AdminEndpoints;

    /**
     * /api/quotes/all – Returns the full curated list of Bitcoin quotes.
     * /api/quotes/$INDEX – Returns the Bitcoin quote with the given index from the curated list.
     * /api/quotes/random – Returns a random Bitcoin quote from the curated list.
     * /api/holidays/all – Returns the full curated list of Bitcoin Holidays.
     * /api/holidays/today – Returns the Bitcoin Holidays celebrated 'today' (i.e. at the time the API call is made). Optional parameters – tzOffsetThe number of hours to offset from UTC for the caller's local timezone, e.g. "-5" for EST
     * /api/holidays/$DAY – Returns the Bitcoin Holidays celebrated on the specified day, using one of the following formats: yyyy-MM-DD, MM-DD.
     */
    use FunEndpoints;
}
