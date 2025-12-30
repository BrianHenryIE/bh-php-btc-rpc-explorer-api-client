<?php

namespace BrianHenryIE\BtcRpcExplorer\Unit;

use BrianHenryIE\BtcRpcExplorer\Endpoints\PriceEndpoints;
use BrianHenryIE\BtcRpcExplorer\MockHttpTestCase;

/**
 * @see PriceEndpoints
 *
 * Note: api-price.json is empty
 * api-price-marketcap.json is empty
 * api-price-sats.json contains error message about disabled exchange rates
 */
class PriceEndpointsTest extends MockHttpTestCase
{
    public function testPrice(): void
    {
        $this->markTestIncomplete('needs fixture data');

        $endpoint = '/api/price';
        $fixture = 'api-docs/api-price.json';

        $sut = $this->getMockClientWithFixture($endpoint, $fixture);

        $result = $sut->price();

        // TODO:
    }

    public function testPriceMarketcap(): void
    {
        $this->markTestIncomplete('needs fixture data');

        $endpoint = '/api/price/marketcap';
        $fixture = 'api-docs/api-price-marketcap.json';

        $sut = $this->getMockClientWithFixture($endpoint, $fixture);

        $result = $sut->marketCapIn('usd');

        // TODO:
    }

    public function testPriceSats(): void
    {
        $this->markTestIncomplete('needs fixture data');

        $endpoint = '/api/price/usd/sats';
        $fixture = 'api-docs/api-price-marketcap.json';

        $sut = $this->getMockClientWithFixture($endpoint, $fixture);

        $result = $sut->priceInSats('usd');

        // TODO:
    }
}
