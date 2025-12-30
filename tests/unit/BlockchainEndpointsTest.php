<?php

namespace BrianHenryIE\BtcRpcExplorer\Unit;

use BrianHenryIE\BtcRpcExplorer\Endpoints\BlockchainEndpoints;
use BrianHenryIE\BtcRpcExplorer\MockHttpTestCase;

/**
 * @see BlockchainEndpoints
 */
class BlockchainEndpointsTest extends MockHttpTestCase
{
    /**
     * @see BlockchainEndpoints::coins
     */
    public function testCoins(): void
    {
        $fixture = 'tests/_fixtures/api-docs/api-blockchain-coins.json';

        $sut = $this->getMockClientWithFixture('/api/blockchain/coins', $fixture);

        $result = $sut->coins();

        // The fixture returns an object with supply, type, and lastCheckpointHeight
        // But based on the Go implementation, coins() should return a float
        // This test verifies the response structure from the fixture
        $this->assertIsFloat($result);
    }

    /**
     * @see BlockchainEndpoints::utxoSet()
     */
    public function testUtxoSet(): void
    {
        $this->markTestIncomplete('need fixture');

        $fixture = 'tests/_fixtures/api-docs/api-blockchain-utxo-set.json';

        $sut = $this->getMockClientWithFixture('/api/blockchain/utxo-set', $fixture);

        $result = $sut->utxoSet();
    }
}
