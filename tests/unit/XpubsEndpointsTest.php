<?php

namespace BrianHenryIE\BtcRpcExplorer\Unit;

use BrianHenryIE\BtcRpcExplorer\Endpoints\XpubsEndpoints;
use BrianHenryIE\BtcRpcExplorer\MockHttpTestCase;

/**
 * @see XpubsEndpoints
 *
 * api-xyzpub-addresses-xpub.json
 * api-xyzpub-txids-xpub.json
 * api-xyzpub-xpub.json
 */
class XpubsEndpointsTest extends MockHttpTestCase
{
    /**
     * @see XpubsEndpoints::extendedPublicKeyDetails()
     */
    public function testExtendedPublicKeyDetails(): void
    {
        $fixture = 'api-docs/api-xyzpub-xpub.json';
        $xpub = 'xpub6D4BDPcP2GT577Vvch3R8wDkScZWzQzMMUm3PWbmWvVJrZwQY4VUNgqFJPMM3No2dFDFGTsxxpG5uJh7n7epu4trkrX7x7DogT5Uv6fcLW5';

        $sut = $this->getMockClientWithFixture('/api/xyzpub/' . $xpub, $fixture);

        $result = $sut->extendedPublicKeyDetails($xpub);

        // Basic properties
        $this->assertEquals('xpub', $result->keyType);
        $this->assertEquals('P2PKH', $result->outputType);
        $this->assertEquals('Pay to Public Key Hash', $result->outputTypeDesc);
        $this->assertEquals("m/44'/0'", $result->bip32Path);

        // Related keys
        $this->assertCount(2, $result->relatedKeys);
        $this->assertEquals('ypub', $result->relatedKeys[0]->keyType);
        $this->assertEquals('ypub6ZjkLiEwNDVeZ6VaFpaULvtV3sGT6n43CvrktC2G6H87ME8PTxCe59inL5QUWnRM4f5LVhkvxPsoR5C33Hqu4Bb3FY35oYPRp6d7CCfcqmo', $result->relatedKeys[0]->key);
        $this->assertEquals('P2WPKH in P2SH', $result->relatedKeys[0]->outputType);
        $this->assertEquals('3JDVonJcuQ7yQQQJh1tFLV74uRZUP6LgvF', $result->relatedKeys[0]->firstAddress);

        $this->assertEquals('zpub', $result->relatedKeys[1]->keyType);
        $this->assertEquals('zpub6ta1eNurWu38QPgh6BN6Z1yzDqQu3Q3Y83Nyfav9UHVzQKwcicNChDNvMHN4Wh5GUJC9FBMVR4EMJMobkzFurRGe7sjWPTCv5pgkaqEA6or', $result->relatedKeys[1]->key);
        $this->assertEquals('P2WPKH', $result->relatedKeys[1]->outputType);
        $this->assertEquals('bc1qdx0pd4h65d7mekkhk7n6jwzfwgqath7s0e368g', $result->relatedKeys[1]->firstAddress);

        // Addresses arrays
        $this->assertCount(20, $result->receiveAddresses);
        $this->assertEquals('1AdTLNfqiQtQ7yRNoZDEFTE9kSri2jrRVD', $result->receiveAddresses[0]);

        $this->assertCount(20, $result->changeAddresses);
        $this->assertEquals('13AGMJSeF7HXzyKWtingr4ZSz14REnuRXh', $result->changeAddresses[0]);
    }

    public function testExtendedPublicKeyAddresses(): void
    {
        $endpoint = '/api/xyzpub/addresses/$XPUB?receiveOrChange=0';
        $fixture = 'api-docs/api-xyzpub-addresses-xpub.json';

        $sut = $this->getMockClientWithFixture($endpoint, $fixture);

        $result = $sut->extendedPublicKeyAddresses('$XPUB');

        $this->assertEquals('1AdTLNfqiQtQ7yRNoZDEFTE9kSri2jrRVD', $result[0]);
    }

    public function testExtendedPublicKeyTransactions(): void
    {
        $endpoint = '/api/xyzpub/txids/$XPUB';
        $fixture = 'api-docs/api-xyzpub-txids-xpub.json';

        $sut = $this->getMockClientWithFixture($endpoint, $fixture);

        $result = $sut->extendedPublicKeyTransactions('$XPUB');

        $this->assertEquals(0, $result->txCount);
    }
}
