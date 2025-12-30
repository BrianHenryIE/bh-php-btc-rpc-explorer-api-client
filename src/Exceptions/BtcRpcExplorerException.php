<?php

namespace BrianHenryIE\BtcRpcExplorer\Exceptions;

use Exception;
use Throwable;

/**
 * {
 *   "success": false,
 *   "error": "You have exchange-rate requests disabled (this is the default state; in your server configuration, you must set BTCEXP_NO_RATES to 'false', and ensure that BTCEXP_PRIVACY_MODE is also still its default value of 'false')"
 * }
 *
 *
 * {"success":false,"error":{"code":"ECONNRESET","userData":{"request":{"method":"getrawtransaction","parameters":["f4184fc596403b9d638783cf57adfe4c75c605f6356fbc91338530e9831e9e16",1]}}}}
 */

class BtcRpcExplorerException extends Exception
{
    public function __construct(
        readonly public string $body,
        string $message = "",
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
