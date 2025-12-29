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

use BrianHenryIE\BtcRpcExplorer\Endpoints\AddressEndpoints;
use BrianHenryIE\BtcRpcExplorer\Endpoints\AdminEndpoints;
use BrianHenryIE\BtcRpcExplorer\Endpoints\BlockchainEndpoints;
use BrianHenryIE\BtcRpcExplorer\Endpoints\BlockEndpoints;
use BrianHenryIE\BtcRpcExplorer\Endpoints\FunEndpoints;
use BrianHenryIE\BtcRpcExplorer\Endpoints\MempoolEndpoints;
use BrianHenryIE\BtcRpcExplorer\Endpoints\MiningEndpoints;
use BrianHenryIE\BtcRpcExplorer\Endpoints\PriceEndpoints;
use BrianHenryIE\BtcRpcExplorer\Endpoints\TransactionEndpoints;
use BrianHenryIE\BtcRpcExplorer\Endpoints\UtilEndpoints;

class BtcRpcExplorerApi extends AbstractApi
{
    use AddressEndpoints;
    use BlockchainEndpoints;
    use BlockEndpoints;
    use TransactionEndpoints;
    use MempoolEndpoints;
    use MiningEndpoints;
    use PriceEndpoints;
    use UtilEndpoints;
    use AdminEndpoints;
    use FunEndpoints;
}
