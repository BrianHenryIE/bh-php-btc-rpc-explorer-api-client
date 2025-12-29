<?php

namespace BrianHenryIE\BtcRpcExplorer\Unit;

use BrianHenryIE\BtcRpcExplorer\Endpoints\AddressEndpoints;
use BrianHenryIE\BtcRpcExplorer\MockHttpTestCase;

/**
 * @see AddressEndpoints
 */
class AddressEndpointTest extends MockHttpTestCase
{
    /**
     * @see AddressEndpoints::addressSummary
     */
    public function testAddress(): void
    {

        $fixture = 'tests/_fixtures/api-docs/api-address-address.json';

        $sut = $this->getMockClientWithFixture('/api/address/123', $fixture);

        $result = $sut->addressSummary('123');

        $this->assertEquals('124dbe6cf2394aa0e566d9b1df021343b563c694283038940e42ac9b24a50fcc', $result->electrumScriptHash);
    }
}
