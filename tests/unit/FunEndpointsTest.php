<?php

namespace BrianHenryIE\BtcRpcExplorer\Unit;

use BrianHenryIE\BtcRpcExplorer\Endpoints\FunEndpoints;
use BrianHenryIE\BtcRpcExplorer\MockHttpTestCase;
use BrianHenryIE\BtcRpcExplorer\Model\HolidayDetails;
use BrianHenryIE\BtcRpcExplorer\Model\HolidaysDay;

/**
 * @see FunEndpoints
 * @see HolidayDetails
 * @see HolidaysDay
 *
 * api-quotes-all.json
 * api-quotes-index.json
 * api-quotes-random.json
 * api-holidays-all.json
 * api-holidays-day.json
 * api-holidays-today.json
 */
class FunEndpointsTest extends MockHttpTestCase
{
    /**
     * @see FunEndpoints::randomQuote
     */
    public function testRandomQuote(): void
    {
        $fixture = 'tests/_fixtures/api-docs/api-quotes-random.json';

        $sut = $this->getMockClientWithFixture('/api/quotes/random', $fixture);

        $result = $sut->randomQuote();

        $this->assertEquals('The lesson of Bitcoin is: bitcoin is the best asset, there is no second best asset, buy bitcoin, keep buying bitcoin, don\'t sell the bitcoin.', $result->text);
        $this->assertEquals('Michael Saylor', $result->speaker);
        $this->assertEquals('https://x.com/TheBTCTherapist/status/1765420027837055306?s=20', $result->url);
        $this->assertEquals('2024-03-06', $result->date);
    }

    /**
     * @see FunEndpoints::quote()
     */
    public function testQuote(): void
    {
        $fixture = 'tests/_fixtures/api-docs/api-quotes-random.json';

        $sut = $this->getMockClientWithFixture('/api/quotes/123', $fixture);

        $result = $sut->quote(123);

        $this->assertEquals('The lesson of Bitcoin is: bitcoin is the best asset, there is no second best asset, buy bitcoin, keep buying bitcoin, don\'t sell the bitcoin.', $result->text);
        $this->assertEquals('Michael Saylor', $result->speaker);
        $this->assertEquals('https://x.com/TheBTCTherapist/status/1765420027837055306?s=20', $result->url);
        $this->assertEquals('2024-03-06', $result->date);
    }

    /**
     * @see FunEndpoints::quotes
     */
    public function testQuotes(): void
    {
        $fixture = 'tests/_fixtures/api-docs/api-quotes-all.json';

        $sut = $this->getMockClientWithFixture('/api/quotes/all', $fixture);

        $result = $sut->quotes();

        $this->assertIsArray($result);
        $this->assertGreaterThan(0, count($result));

        // Test first quote (Genesis block)
        $this->assertEquals('The Times 03/Jan/2009 Chancellor on brink of second bailout for banks.', $result[0]->text);
        $this->assertEquals('Satoshi', $result[0]->speaker);
        $this->assertEquals('./block-height/0', $result[0]->url);
        $this->assertEquals('2009-01-03', $result[0]->date);
        $this->assertEquals('embedded in the Genesis block', $result[0]->context);
    }

    /**
     * @see FunEndpoints::holidays()
     */
    public function testHolidaysAll(): void
    {
        $fixture = 'api-docs/api-holidays-all.json';

        $sut = $this->getMockClientWithFixture('/api/holidays/all', $fixture);

        $result = $sut->holidays();

        // Should return an array of holidays
        $this->assertIsArray($result);
        $this->assertGreaterThan(0, count($result));

        // Test first holiday - Satoshi's Birthday
        $this->assertEquals("Satoshi's Birthday", $result[0]->name);
        $this->assertEquals('1975-04-05', $result[0]->date);
        $this->assertStringContainsString('Satoshi Nakamoto listed their birthday', $result[0]->description);

        // Test Bitcoin's Birthday (Genesis Block)
        $bitcoinBirthday = null;
        foreach ($result as $holiday) {
            if ($holiday->name === "Bitcoin's Birthday") {
                $bitcoinBirthday = $holiday;
                break;
            }
        }
        $this->assertNotNull($bitcoinBirthday);
        $this->assertEquals('2009-01-03', $bitcoinBirthday->date);
        $this->assertStringContainsString('Genesis Block', $bitcoinBirthday->description);

        // Test Bitcoin Whitepaper Day
        $whitepaperDay = null;
        foreach ($result as $holiday) {
            if ($holiday->name === 'Bitcoin Whitepaper Day') {
                $whitepaperDay = $holiday;
                break;
            }
        }
        $this->assertNotNull($whitepaperDay);
        $this->assertEquals('2008-10-31', $whitepaperDay->date);
        $this->assertStringContainsString('Satoshi Nakamoto released the Bitcoin white paper', $whitepaperDay->description);

        // Test HODL Day
        $hodlDay = null;
        foreach ($result as $holiday) {
            if ($holiday->name === 'HODL Day') {
                $hodlDay = $holiday;
                break;
            }
        }
        $this->assertNotNull($hodlDay);
        $this->assertEquals('2013-12-18', $hodlDay->date);
        $this->assertStringContainsString('I AM HODLING', $hodlDay->description);

        // Test Bitcoin Pizza Day
        $pizzaDay = null;
        foreach ($result as $holiday) {
            if ($holiday->name === 'Bitcoin Pizza Day') {
                $pizzaDay = $holiday;
                break;
            }
        }
        $this->assertNotNull($pizzaDay);
        $this->assertEquals('2010-05-22', $pizzaDay->date);
        $this->assertStringContainsString('10,000 BTC for two pizzas', $pizzaDay->description);
    }

    /**
     * @see FunEndpoints::holidaysForDay()
     */
    public function testHolidaysForSpecificDay(): void
    {
        $fixture = 'api-docs/api-holidays-day.json';

        $sut = $this->getMockClientWithFixture('/api/holidays/01-03', $fixture);

        $result = $sut->holidaysOn('01-03');

        // Verify response structure
        $this->assertEquals('01-03', $result->day);
        $this->assertIsArray($result->holidays);
        $this->assertCount(2, $result->holidays);

        // First holiday - Bitcoin's Birthday
        $this->assertEquals("Bitcoin's Birthday", $result->holidays[0]->name);
        $this->assertEquals('2009-01-03', $result->holidays[0]->date);
        $this->assertStringContainsString('Genesis Block', $result->holidays[0]->description);
        $this->assertStringContainsString('Satoshi Nakamoto', $result->holidays[0]->description);

        // Second holiday - Proof of Keys Day
        $this->assertEquals('Proof of Keys Day', $result->holidays[1]->name);
        $this->assertEquals('2019-01-03', $result->holidays[1]->date);
        $this->assertStringContainsString('Trace Mayer', $result->holidays[1]->description);
        $this->assertStringContainsString('Not your keys, not your bitcoin', $result->holidays[1]->description);
    }

    /**
     * @see FunEndpoints::holidaysToday()
     */
    public function testHolidaysToday(): void
    {
        $fixture = 'api-docs/api-holidays-today.json';

        $sut = $this->getMockClientWithFixture('/api/holidays/today?tzOffset=0', $fixture);

        $result = $sut->holidaysToday();

        // Verify response structure
        $this->assertEquals('12-29', $result->day);
        $this->assertIsArray($result->holidays);
        $this->assertEmpty($result->holidays);
    }
}
