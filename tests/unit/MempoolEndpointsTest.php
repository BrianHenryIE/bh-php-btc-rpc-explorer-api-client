<?php

namespace BrianHenryIE\BtcRpcExplorer\Unit;

use BrianHenryIE\BtcRpcExplorer\Endpoints\MempoolEndpoints;
use BrianHenryIE\BtcRpcExplorer\MockHttpTestCase;

/**
 * @see MempoolEndpoints
 *
 * api-mempool-count.json
 * api-mempool-fees.json
 * api-mempool-summary.json
 */
class MempoolEndpointsTest extends MockHttpTestCase
{
    /**
     * @see MempoolEndpoints::mempoolCount()
     */
    public function testMempoolCount(): void
    {
        $fixture = 'api-docs/api-mempool-count.json';

        $sut = $this->getMockClientWithFixture('/api/mempool/count', $fixture);

        $result = $sut->mempoolCount();

        $this->assertEquals(0, $result);
    }

    /**
     * @see MempoolEndpoints::mempoolSummary()
     */
    public function testMempoolSummary(): void
    {
        $fixture = 'api-docs/api-mempool-summary.json';

        $sut = $this->getMockClientWithFixture('/api/mempool/summary', $fixture);

        $result = $sut->mempoolSummary();

        $this->assertTrue($result->loaded);
        $this->assertEquals(0, $result->size);
        $this->assertEquals(0, $result->bytes);
        $this->assertEquals(0, $result->usage);
        $this->assertEquals(0, $result->totalFee);
        $this->assertEquals(200000000, $result->maxMempool);
        $this->assertEquals(0.000001, $result->mempoolMinFee);
        $this->assertEquals(0.000001, $result->minRelayTxFee);
        $this->assertEquals(0.000001, $result->incrementalRelayFee);
        $this->assertEquals(0, $result->unbroadcastCount);
        $this->assertTrue($result->fullReplaceByFee);
    }

    /**
     * @see MempoolEndpoints::mempoolFees()
     */
    public function testMempoolFees(): void
    {
        $this->markTestIncomplete('until blockchain has synced, to get real data.');

        $fixture = 'api-docs/api-mempool-fees.json';

        $sut = $this->getMockClientWithFixture('/api/mempool/fees', $fixture);

        $result = $sut->mempoolFees();
    }
}
