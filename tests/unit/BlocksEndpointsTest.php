<?php

/**
 * Blocks
 *
 * /api/block/$HASH – Returns the details of the block with the given hash.
 * /api/block/$HEIGHT – Returns the details of the block at the given height.
 * /api/block/header/$HASH – Returns the details of the block header with the given hash.
 * /api/block/header/$HEIGHT – Returns the details of the block header at the given height.
 * /api/blocks/tip – Returns basic details about the chain tip.
 */

namespace BrianHenryIE\BtcRpcExplorer\Unit;

use BrianHenryIE\BtcRpcExplorer\Endpoints\BlocksEndpoints;
use BrianHenryIE\BtcRpcExplorer\MockHttpTestCase;
use BrianHenryIE\BtcRpcExplorer\Model\BlockDetails;
use BrianHenryIE\BtcRpcExplorer\Model\Tip;

/**
 * @see BlocksEndpoints
 * @see BlockDetails
 * @see Tip
 *
 * api-block-hash.json
 * api-block-header-hash.json
 * api-block-header-height.json
 * api-block-height.json
 * api-blocks-tip.json
 */
class BlocksEndpointsTest extends MockHttpTestCase
{
    /**
     * @see BlocksEndpoints::blockWithHash
     */
    public function testBlockByHash(): void
    {
        $fixture = 'api-docs/api-block-hash.json';

        $sut = $this->getMockClientWithFixture('/api/block/0000000000000000001c8018d9cb3b742ef25114f27563e3fc4a1902167f9893', $fixture);

        $result = $sut->blockWithHash('0000000000000000001c8018d9cb3b742ef25114f27563e3fc4a1902167f9893');

        // Basic block properties
        $this->assertEquals('0000000000000000001c8018d9cb3b742ef25114f27563e3fc4a1902167f9893', $result->hash);
        $this->assertEquals(-1, $result->confirmations);
        $this->assertEquals(481824, $result->height);
        $this->assertEquals(536870914, $result->version);
        $this->assertEquals('20000002', $result->versionHex);
        $this->assertEquals('6438250cad442b982801ae6994edb8a9ec63c0a0ba117779fbe7ef7f07cad140', $result->merkleroot);
        $this->assertEquals(1503539857, $result->time);
        $this->assertEquals(1503536701, $result->mediantime);
        $this->assertEquals(575995682, $result->nonce);
        $this->assertEquals('18013ce9', $result->bits);
// TODO: This float is being cast to '888171856257.32'.
//        $this->assertEquals('888171856257.3206', $result->difficulty);
        $this->assertEquals('0000000000000000000000000000000000000000007eb6a652531c5ad6a4b8e9', $result->chainwork);
        $this->assertEquals(0, $result->nTx);
        $this->assertEquals('000000000000000000cbeff0b533f8e1189cf09dfbebf57a8ebe349362811b80', $result->previousblockhash);

        // Transactions array
        $this->assertIsArray($result->tx);
        $this->assertEmpty($result->tx);
    }

    /**
     * @see BlocksEndpoints::blockWithHeight()
     */
    public function testBlockByHeight(): void
    {
        $fixture = 'api-docs/api-block-height.json';

        $sut = $this->getMockClientWithFixture('/api/block/123456', $fixture);

        $result = $sut->blockWithHeight(123456);

        // Basic block properties
        $this->assertEquals('0000000000002917ed80650c6174aac8dfc46f5fe36480aaef682ff6cd83c3ca', $result->hash);
        $this->assertEquals(61147, $result->confirmations);
        $this->assertEquals(123456, $result->height);
        $this->assertEquals(1, $result->version);
        $this->assertEquals('00000001', $result->versionHex);
        $this->assertEquals('0e60651a9934e8f0decd1c5fde39309e48fca0cd1c84a21ddfde95033762d86c', $result->merkleroot);
        $this->assertEquals(1305200806, $result->time);
        $this->assertEquals(1305197900, $result->mediantime);
        $this->assertEquals(2436437219, $result->nonce);
        $this->assertEquals('1a6a93b3', $result->bits);
        $this->assertEquals('000000000000000000000000000000000000000000000000541788211ac227bc', $result->chainwork);
        $this->assertEquals(13, $result->nTx);
        $this->assertEquals('0000000000000b60bc96a44724fd72daf9b92cf8ad00510b5224c6253ac40095', $result->previousblockhash);
        $this->assertEquals('000000000000129f5f02be247070bf7334d3753e4ddee502780c2acaecec6d66', $result->nextblockhash);
        $this->assertEquals(4179, $result->strippedsize);
        $this->assertEquals(4179, $result->size);
        $this->assertEquals(16716, $result->weight);

        // Transactions array
        $this->assertIsArray($result->tx);
        $this->assertCount(13, $result->tx);
        $this->assertEquals('5b75086dafeede555fc8f9a810d8b10df57c46f9f176ccc3dd8d2fa20edd685b', $result->tx[0]);

        // Coinbase transaction
        $this->assertTrue($result->coinbaseTx->inActiveChain);
        $this->assertEquals('5b75086dafeede555fc8f9a810d8b10df57c46f9f176ccc3dd8d2fa20edd685b', $result->coinbaseTx->txId);
        $this->assertEquals('5b75086dafeede555fc8f9a810d8b10df57c46f9f176ccc3dd8d2fa20edd685b', $result->coinbaseTx->hash);
        $this->assertEquals(1, $result->coinbaseTx->version);
        $this->assertEquals(134, $result->coinbaseTx->size);
        $this->assertEquals(134, $result->coinbaseTx->vsize);
        $this->assertEquals(536, $result->coinbaseTx->weight);
        $this->assertEquals(0, $result->coinbaseTx->locktime);

        // Coinbase vin
        $this->assertCount(1, $result->coinbaseTx->vin);
        $this->assertEquals('04b3936a1a017c', $result->coinbaseTx->vin[0]->coinbase);
        $this->assertEquals(4294967295, $result->coinbaseTx->vin[0]->sequence);

        // Coinbase vout
        $this->assertCount(1, $result->coinbaseTx->vout);
        $this->assertEquals(50.05, $result->coinbaseTx->vout[0]->value);
        $this->assertEquals(0, $result->coinbaseTx->vout[0]->n);
        $this->assertEquals('04563053b8900762f3d3e8725012d617d177e3c4af3275c3265a1908b434e0df91ec75603d0d8955ef040e5f68d5c36989efe21a59f4ef94a5cc95c99794a84492 OP_CHECKSIG', $result->coinbaseTx->vout[0]->scriptPubKey->asm);
        $this->assertEquals('4104563053b8900762f3d3e8725012d617d177e3c4af3275c3265a1908b434e0df91ec75603d0d8955ef040e5f68d5c36989efe21a59f4ef94a5cc95c99794a84492ac', $result->coinbaseTx->vout[0]->scriptPubKey->hex);
        $this->assertEquals('pubkey', $result->coinbaseTx->vout[0]->scriptPubKey->type);

        $this->assertEquals('01000000010000000000000000000000000000000000000000000000000000000000000000ffffffff0704b3936a1a017cffffffff01403d522a01000000434104563053b8900762f3d3e8725012d617d177e3c4af3275c3265a1908b434e0df91ec75603d0d8955ef040e5f68d5c36989efe21a59f4ef94a5cc95c99794a84492ac00000000', $result->coinbaseTx->hex);
        $this->assertEquals('0000000000002917ed80650c6174aac8dfc46f5fe36480aaef682ff6cd83c3ca', $result->coinbaseTx->blockhash);
        $this->assertEquals(61147, $result->coinbaseTx->confirmations);
        $this->assertEquals(1305200806, $result->coinbaseTx->time);
        $this->assertEquals(1305200806, $result->coinbaseTx->blocktime);
    }

    /**
     * @see BlocksEndpoints::blockHeaderWithHash()
     */
    public function testBlockHeaderByHash(): void
    {
        $fixture = 'api-docs/api-block-header-hash.json';

        $sut = $this->getMockClientWithFixture('/api/block/header/0000000000000000001c8018d9cb3b742ef25114f27563e3fc4a1902167f9893', $fixture);

        $result = $sut->blockHeaderWithHash('0000000000000000001c8018d9cb3b742ef25114f27563e3fc4a1902167f9893');

        // Block header properties
        $this->assertEquals('0000000000000000001c8018d9cb3b742ef25114f27563e3fc4a1902167f9893', $result->hash);
        $this->assertEquals(-1, $result->confirmations);
        $this->assertEquals(481824, $result->height);
        $this->assertEquals(536870914, $result->version);
        $this->assertEquals('20000002', $result->versionHex);
        $this->assertEquals('6438250cad442b982801ae6994edb8a9ec63c0a0ba117779fbe7ef7f07cad140', $result->merkleroot);
        $this->assertEquals(1503539857, $result->time);
        $this->assertEquals(1503536701, $result->mediantime);
        $this->assertEquals(575995682, $result->nonce);
        $this->assertEquals('18013ce9', $result->bits);
        $this->assertEquals('0000000000000000000000000000000000000000007eb6a652531c5ad6a4b8e9', $result->chainwork);
        $this->assertEquals(0, $result->nTx);
        $this->assertEquals('000000000000000000cbeff0b533f8e1189cf09dfbebf57a8ebe349362811b80', $result->previousblockhash);
    }

    /**
     * @see BlocksEndpoints::blockHeaderWithHeight()
     */
    public function testBlockHeaderByHeight(): void
    {
        $fixture = 'api-docs/api-block-header-height.json';

        $sut = $this->getMockClientWithFixture('/api/block/header/123456', $fixture);

        $result = $sut->blockHeaderWithHeight(123456);

        // Block header properties
        $this->assertEquals('0000000000002917ed80650c6174aac8dfc46f5fe36480aaef682ff6cd83c3ca', $result->hash);
        $this->assertEquals(61147, $result->confirmations);
        $this->assertEquals(123456, $result->height);
        $this->assertEquals(1, $result->version);
        $this->assertEquals('00000001', $result->versionHex);
        $this->assertEquals('0e60651a9934e8f0decd1c5fde39309e48fca0cd1c84a21ddfde95033762d86c', $result->merkleroot);
        $this->assertEquals(1305200806, $result->time);
        $this->assertEquals(1305197900, $result->mediantime);
        $this->assertEquals(2436437219, $result->nonce);
        $this->assertEquals('1a6a93b3', $result->bits);
        $this->assertEquals('000000000000000000000000000000000000000000000000541788211ac227bc', $result->chainwork);
        $this->assertEquals(13, $result->nTx);
        $this->assertEquals('0000000000000b60bc96a44724fd72daf9b92cf8ad00510b5224c6253ac40095', $result->previousblockhash);
        $this->assertEquals('000000000000129f5f02be247070bf7334d3753e4ddee502780c2acaecec6d66', $result->nextblockhash);
    }

    /**
     * @see BlocksEndpoints::tip()
     */
    public function testTip(): void
    {
        $fixture = 'api-docs/api-blocks-tip.json';

        $sut = $this->getMockClientWithFixture('/api/blocks/tip', $fixture);

        $result = $sut->tip();

        $this->assertEquals(184602, $result->height);
        $this->assertEquals('0000000000000716ccee0ecadafa54ddaad6537493533d5b634ecda816d30b80', $result->hash);
    }
}
