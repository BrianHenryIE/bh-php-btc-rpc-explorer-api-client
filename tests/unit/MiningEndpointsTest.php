<?php

namespace BrianHenryIE\BtcRpcExplorer\Unit;

use BrianHenryIE\BtcRpcExplorer\Endpoints\MiningEndpoints;
use BrianHenryIE\BtcRpcExplorer\MockHttpTestCase;

/**
 * @see MiningEndpoints
 *
 * api-mining-diff-adj-estimate.json
 * api-mining-hashrate.json
 * api-mining-miner-summary.json
 * api-mining-next-block.json
 * api-mining-next-block-includes-txid.json
 * api-mining-next-block-txids.json
 */
class MiningEndpointsTest extends MockHttpTestCase
{
    /**
     * @see MiningEndpoints::hashrate()
     */
    public function testHashrate(): void
    {
        $fixture = 'api-docs/api-mining-hashrate.json';

        $sut = $this->getMockClientWithFixture('/api/mining/hashrate', $fixture);

        $result = $sut->hashrate();

        // Test 1 Day hashrate
        $this->assertEquals(11.894, $result->oneDay->val);
        $this->assertEquals('terahash', $result->oneDay->unit);
        $this->assertEquals('TH', $result->oneDay->unitAbbreviation);
        $this->assertEquals('12', $result->oneDay->unitExponent);
        $this->assertEquals(1000000000000, $result->oneDay->unitMultiplier);
        $this->assertEquals(11894000000000, $result->oneDay->raw);
        $this->assertEquals('11.894x10^12', $result->oneDay->string1);
        $this->assertEquals('11.894e12', $result->oneDay->string2);
        $this->assertEquals('11,894,000,000,000', $result->oneDay->string3);

        // Test 7 Day hashrate
        $this->assertEquals(12.218, $result->sevenDay->val);
        $this->assertEquals('terahash', $result->sevenDay->unit);
        $this->assertEquals('TH', $result->sevenDay->unitAbbreviation);
        $this->assertEquals('12', $result->sevenDay->unitExponent);
        $this->assertEquals(1000000000000, $result->sevenDay->unitMultiplier);
        $this->assertEquals(12218000000000, $result->sevenDay->raw);
        $this->assertEquals('12.218x10^12', $result->sevenDay->string1);
        $this->assertEquals('12.218e12', $result->sevenDay->string2);
        $this->assertEquals('12,218,000,000,000', $result->sevenDay->string3);

        // Test 30 Day hashrate
        $this->assertEquals(11.804, $result->thirtyDay->val);
        $this->assertEquals('terahash', $result->thirtyDay->unit);
        $this->assertEquals('TH', $result->thirtyDay->unitAbbreviation);
        $this->assertEquals('12', $result->thirtyDay->unitExponent);
        $this->assertEquals(1000000000000, $result->thirtyDay->unitMultiplier);
        $this->assertEquals(11804000000000, $result->thirtyDay->raw);
        $this->assertEquals('11.804x10^12', $result->thirtyDay->string1);
        $this->assertEquals('11.804e12', $result->thirtyDay->string2);
        $this->assertEquals('11,804,000,000,000', $result->thirtyDay->string3);

        // Test 90 Day hashrate
        $this->assertEquals(11.539, $result->ninetyDay->val);
        $this->assertEquals('terahash', $result->ninetyDay->unit);
        $this->assertEquals('TH', $result->ninetyDay->unitAbbreviation);
        $this->assertEquals('12', $result->ninetyDay->unitExponent);
        $this->assertEquals(1000000000000, $result->ninetyDay->unitMultiplier);
        $this->assertEquals(11539000000000, $result->ninetyDay->raw);
        $this->assertEquals('11.539x10^12', $result->ninetyDay->string1);
        $this->assertEquals('11.539e12', $result->ninetyDay->string2);
        $this->assertEquals('11,539,000,000,000', $result->ninetyDay->string3);

        // Test 365 Day (1 year) hashrate
        $this->assertEquals(10.728, $result->oneYear->val);
        $this->assertEquals('terahash', $result->oneYear->unit);
        $this->assertEquals('TH', $result->oneYear->unitAbbreviation);
        $this->assertEquals('12', $result->oneYear->unitExponent);
        $this->assertEquals(1000000000000, $result->oneYear->unitMultiplier);
        $this->assertEquals(10728000000000, $result->oneYear->raw);
        $this->assertEquals('10.728x10^12', $result->oneYear->string1);
        $this->assertEquals('10.728e12', $result->oneYear->string2);
        $this->assertEquals('10,728,000,000,000', $result->oneYear->string3);
    }

    /**
     * @see MiningEndpoints::difficultyAdjustmentEstimate()
     */
    public function testDiffAdjEstimate(): void
    {
        $fixture = 'api-docs/api-mining-diff-adj-estimate.json';

        $sut = $this->getMockClientWithFixture('/api/mining/diff-adj-estimate', $fixture);

        $result = $sut->difficultyAdjustmentEstimate();

        $this->assertEquals(-75.00, $result);
    }

    /**
     * @see MiningEndpoints::nextBlock()
     */
    public function testNextBlock(): void
    {
        $this->markTestIncomplete('Fixture is empty - requires mempool with transactions.');

        $fixture = 'api-docs/api-mining-next-block.json';

        $sut = $this->getMockClientWithFixture('/api/mining/next-block', $fixture);

        $result = $sut->nextBlock();
    }

    /**
     * @see MiningEndpoints::nextBlockTXIDs()
     */
    public function testNextBlockTxIds(): void
    {
        $fixture = 'api-docs/api-mining-next-block-txids.json';

        $sut = $this->getMockClientWithFixture('/api/mining/next-block/txids', $fixture);

        $result = $sut->nextBlockTXIDs();

        // Fixture contains empty array
        $this->assertEmpty($result);
    }

    /**
     * @see MiningEndpoints::nextBlockIncludes()
     */
    public function testNextBlockIncludesTxid(): void
    {
        $fixture = 'api-docs/api-mining-next-block-includes-txid.json';
        $txid = 'abc123';

        $sut = $this->getMockClientWithFixture("/api/mining/next-block/includes/{$txid}", $fixture);

        $result = $sut->nextBlockIncludes($txid);

        // Fixture contains {"included": false}
        $this->assertFalse($result);
    }

    /**
     * @see MiningEndpoints::minerSummary()
     */
    public function testMinerSummary(): void
    {
        $fixture = 'api-docs/api-mining-miner-summary.json';
        $since = '1d';

        $sut = $this->getMockClientWithFixture("/api/mining/miner-summary?since={$since}", $fixture);

        $result = $sut->minerSummary($since);

        // Test overall stats
        $this->assertEquals(145, $result->overall->blockCount);
        $this->assertEquals('14.13913315', $result->overall->totalFees);
        $this->assertEquals('7250', $result->overall->totalSubsidy);
        $this->assertEquals(21464, $result->overall->totalTransactions);
        $this->assertEquals(41544380, $result->overall->totalWeight);
        $this->assertEquals(145, $result->overall->subsidyCount);

        // Test minerNamesSortedByBlockCount array
        $this->assertCount(14, $result->minerNamesSortedByBlockCount);
        $this->assertEquals('Unknown', $result->minerNamesSortedByBlockCount[0]);
        $this->assertEquals('BTC Guild', $result->minerNamesSortedByBlockCount[1]);
        $this->assertEquals('SlushPool', $result->minerNamesSortedByBlockCount[2]);

        // Test miners array
        $this->assertCount(14, $result->miners);

        // Test SlushPool miner details
        $this->assertArrayHasKey('SlushPool', $result->miners);
        $slushPool = $result->miners['SlushPool'];
        $this->assertEquals('SlushPool', $slushPool->name);
        $this->assertEquals('SlushPool', $slushPool->details?->name);
        $this->assertEquals('https://slushpool.com/', $slushPool->details?->link);
        $this->assertEquals("coinbase tag '/slush/'", $slushPool->details?->identifiedBy);
        $this->assertIsArray($slushPool->blocks);
        $this->assertCount(18, $slushPool->blocks);
        $this->assertEquals(185665, $slushPool->blocks[0]);
        $this->assertEquals(185807, $slushPool->blocks[17]);
        $this->assertEquals('2.79538206', $slushPool->totalFees);
        $this->assertEquals('900', $slushPool->totalSubsidy);
        $this->assertEquals(3683, $slushPool->totalTransactions);
        $this->assertEquals(7897604, $slushPool->totalWeight);
        $this->assertEquals(18, $slushPool->subsidyCount);

        // Test Unknown miner (has null details)
        $this->assertArrayHasKey('Unknown', $result->miners);
        $unknown = $result->miners['Unknown'];
        $this->assertEquals('Unknown', $unknown->name);
        $this->assertNull($unknown->details);
        $this->assertIsArray($unknown->blocks);
        $this->assertCount(61, $unknown->blocks);
        $this->assertEquals(185666, $unknown->blocks[0]);
        $this->assertEquals('3.60738447', $unknown->totalFees);
        $this->assertEquals('3050', $unknown->totalSubsidy);
        $this->assertEquals(6679, $unknown->totalTransactions);
        $this->assertEquals(10942520, $unknown->totalWeight);
        $this->assertEquals(61, $unknown->subsidyCount);

        // Test address-only miner (has type instead of link)
        $this->assertArrayHasKey('address-only:14Dj368DZyFPDbSbERf53wcGLWefsZUamn', $result->miners);
        $addressOnly = $result->miners['address-only:14Dj368DZyFPDbSbERf53wcGLWefsZUamn'];
        $this->assertEquals('address-only:14Dj368DZyFPDbSbERf53wcGLWefsZUamn', $addressOnly->name);
        $this->assertEquals('14Dj368DZyFPDbSbERf53wcGLWefsZUamn', $addressOnly->details?->name);
        $this->assertEquals('payout address 14Dj368DZyFPDbSbERf53wcGLWefsZUamn', $addressOnly->details?->identifiedBy);
        $this->assertIsArray($addressOnly->blocks);
        $this->assertCount(8, $addressOnly->blocks);
        $this->assertEquals('1.0901051', $addressOnly->totalFees);
        $this->assertEquals('400', $addressOnly->totalSubsidy);
        $this->assertEquals(1536, $addressOnly->totalTransactions);
        $this->assertEquals(3638636, $addressOnly->totalWeight);
        $this->assertEquals(8, $addressOnly->subsidyCount);

        // Test BTC Guild miner
        $this->assertArrayHasKey('BTC Guild', $result->miners);
        $btcGuild = $result->miners['BTC Guild'];
        $this->assertEquals('BTC Guild', $btcGuild->name);
        $this->assertEquals('BTC Guild', $btcGuild->details?->name);
        $this->assertEquals('http://www.btcguild.com/', $btcGuild->details?->link);
        $this->assertEquals("coinbase tag 'BTC Guild'", $btcGuild->details?->identifiedBy);
        $this->assertIsArray($btcGuild->blocks);
        $this->assertCount(21, $btcGuild->blocks);
        $this->assertEquals('0.75850797', $btcGuild->totalFees);
        $this->assertEquals('1050', $btcGuild->totalSubsidy);
        $this->assertEquals(1517, $btcGuild->totalTransactions);
        $this->assertEquals(3209772, $btcGuild->totalWeight);
        $this->assertEquals(21, $btcGuild->subsidyCount);
    }
}
