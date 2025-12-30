<?php

/**
 * Price endpoints
 *
 * /api/price – Returns the price of 1 BTC, in USD, EUR, GBP, and XAU
 * /api/price/marketcap – Returns the market cap of Bitcoin, in USD, EUR, GBP, XAU
 * /api/price/sats – Returns the price of 1 unit of [USD, EUR, GBP, XAU] (e.g. 1 "usd") in satoshis (aka "Moscow Time")
 *
 * @package brianhenryie/bh-php-btc-rpc-explorer-api-client
 */

namespace BrianHenryIE\BtcRpcExplorer\Endpoints;

use BrianHenryIE\BtcRpcExplorer\Model\Price;

trait PriceEndpoints
{
    /**
     * Get the price of 1 BTC in USD, EUR, GBP, and XAU.
     */
    public function price(): Price
    {
        return $this->callApi('/price', Price::class);
    }

    /**
     * Get the price of 1 BTC in a specific currency.
     *
     * @param string $currency Currency code (usd, eur, gbp, xau)
     */
    public function priceIn(string $currency): string
    {
        return $this->callApi("/price/" . strtolower($currency), 'string');
    }

    /**
     * Get the market cap in a specific currency.
     *
     * @param string $currency Currency code (usd, eur, gbp, xau)
     */
    public function marketCapIn(string $currency): float
    {
        $response = $this->callApi("/price/" . strtolower($currency) . "/marketcap", 'float');
        return (float) $response;
    }

    /**
     * Get the value in satoshis of one unit of currency.
     *
     * @param string $currency Currency code (usd, eur, gbp, xau)
     */
    public function priceInSats(string $currency): int
    {
        $response = $this->callApi("/price/" . strtolower($currency) . "/sats", 'int');
        return (int) $response;
    }
}
