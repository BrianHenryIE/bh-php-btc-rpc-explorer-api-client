<?php

namespace BrianHenryIE\BtcRpcExplorer\Unit;

use BrianHenryIE\BtcRpcExplorer\Endpoints\AddressesEndpoints;
use BrianHenryIE\BtcRpcExplorer\MockHttpTestCase;

/**
 * @see AddressesEndpoints
 */
class AddressesEndpointsTest extends MockHttpTestCase
{
    /**
     * @see AddressesEndpoints::addressSummary
     */
    public function testAddress(): void
    {

        $fixture = 'tests/_fixtures/api-docs/api-address-address.json';

        $sut = $this->getMockClientWithFixture('/api/address/123', $fixture);

        $result = $sut->addressSummary('123');

        // base58
        $this->assertEquals('22c17a06117b40516f9826804800003562e834c9', $result->base58->hash);
        $this->assertEquals(5, $result->base58->version);

        // encoding
        $this->assertEquals('base58', $result->encoding);

        // validateaddress
        $this->assertTrue($result->validateAddress->isValid);
        $this->assertEquals('34rng4QwB5pHUbGDJw1JxjLwgEU8TQuEqv', $result->validateAddress->address);
        $this->assertEquals('a91422c17a06117b40516f9826804800003562e834c987', $result->validateAddress->scriptPubKey);
        $this->assertTrue($result->validateAddress->isScript);
        $this->assertFalse($result->validateAddress->isWitness);

        // electrumScriptHash
        $this->assertEquals('124dbe6cf2394aa0e566d9b1df021343b563c694283038940e42ac9b24a50fcc', $result->electrumScriptHash);

        // txHistory
        $this->assertEquals(0, $result->txHistory->txCount);
        $this->assertEmpty($result->txHistory->txIds);
        $this->assertEmpty($result->txHistory->blockHeightsByTxId);
        $this->assertEquals(0, $result->txHistory->balanceSat);

        // txHistory.request
        $this->assertEquals(10, $result->txHistory->request->limit);
        $this->assertEquals(0, $result->txHistory->request->offset);
        $this->assertEquals('desc', $result->txHistory->request->sort);
    }
}
