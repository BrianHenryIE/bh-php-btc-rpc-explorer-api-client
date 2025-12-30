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

        $this->assertEquals('0.0', $result);
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
