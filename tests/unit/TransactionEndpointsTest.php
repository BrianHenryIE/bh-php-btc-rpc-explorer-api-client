<?php

namespace BrianHenryIE\BtcRpcExplorer\Unit;

use BrianHenryIE\BtcRpcExplorer\Endpoints\TransactionEndpoints;
use BrianHenryIE\BtcRpcExplorer\MockHttpTestCase;

/**
 * @see TransactionEndpoints
 */
class TransactionEndpointsTest extends MockHttpTestCase
{
    /**
     * @see TransactionEndpoints::tx
     */
    public function testTx(): void
    {
        $fixture = 'tests/_fixtures/api-docs/api-tx-txid.json';

        $sut = $this->getMockClientWithFixture('/api/tx/f4184fc596403b9d638783cf57adfe4c75c605f6356fbc91338530e9831e9e16', $fixture);

        $result = $sut->tx('f4184fc596403b9d638783cf57adfe4c75c605f6356fbc91338530e9831e9e16');

        // Basic transaction properties
        $this->assertEquals('f4184fc596403b9d638783cf57adfe4c75c605f6356fbc91338530e9831e9e16', $result->txId);
        $this->assertEquals('f4184fc596403b9d638783cf57adfe4c75c605f6356fbc91338530e9831e9e16', $result->hash);
        $this->assertEquals(1, $result->version);
        $this->assertEquals(275, $result->size);
        $this->assertEquals(275, $result->vSize);
        $this->assertEquals(1100, $result->weight);
        $this->assertEquals(0, $result->lockTime);
        $this->assertEquals('0100000001c997a5e56e104102fa209c6a852dd90660a20b2d9c352423edce25857fcd3704000000004847304402204e45e16932b8af514961a1d3a1a25fdf3f4f7732e9d624c6c61548ab5fb8cd410220181522ec8eca07de4860a4acdd12909d831cc56cbbac4622082221a8768d1d0901ffffffff0200ca9a3b00000000434104ae1a62fe09c5f51b13905f07f06b99a2f7159b2225f374cd378d71302fa28414e7aab37397f554a7df5f142c21c1b7303b8a0626f1baded5c72a704f7e6cd84cac00286bee0000000043410411db93e1dcdb8a016b49840f8c53bc1eb68a382e97b1482ecad7b148a6909a5cb2e0eaddfb84ccf9744464f82e160bfa9b8b64f9d4c03f999b8643f656b412a3ac00000000', $result->hex);
        $this->assertEquals('00000000d1145790a8694403d4063f323d499e655c83426834d4ce2f8dd4a2ee', $result->blockHash);
        $this->assertEquals(184433, $result->confirmations);
        $this->assertEquals(1231731025, $result->blockTime);
        $this->assertEquals('2009-01-12', $result->getBlockTime()->format('Y-m-d'));

        // Test vIn array
        $this->assertCount(1, $result->vIn);
        $this->assertEquals('0437cd7f8525ceed2324359c2d0ba26006d92d856a9c20fa0241106ee5a597c9', $result->vIn[0]->txId);
        $this->assertEquals(0, $result->vIn[0]->vOut);
        $this->assertEquals(4294967295, $result->vIn[0]->sequence);

        // Test vIn scriptSig
        $this->assertEquals('304402204e45e16932b8af514961a1d3a1a25fdf3f4f7732e9d624c6c61548ab5fb8cd410220181522ec8eca07de4860a4acdd12909d831cc56cbbac4622082221a8768d1d09[ALL]', $result->vIn[0]->scriptSig?->asm);
        $this->assertEquals('47304402204e45e16932b8af514961a1d3a1a25fdf3f4f7732e9d624c6c61548ab5fb8cd410220181522ec8eca07de4860a4acdd12909d831cc56cbbac4622082221a8768d1d0901', $result->vIn[0]->scriptSig?->hex);

        // Test vOut array
        $this->assertCount(2, $result->vOut);

        // Test first vOut
        $this->assertEquals(10, $result->vOut[0]->value);
        $this->assertEquals(0, $result->vOut[0]->n);
        $this->assertEquals('04ae1a62fe09c5f51b13905f07f06b99a2f7159b2225f374cd378d71302fa28414e7aab37397f554a7df5f142c21c1b7303b8a0626f1baded5c72a704f7e6cd84c OP_CHECKSIG', $result->vOut[0]->scriptPubKey->asm);
        $this->assertEquals('4104ae1a62fe09c5f51b13905f07f06b99a2f7159b2225f374cd378d71302fa28414e7aab37397f554a7df5f142c21c1b7303b8a0626f1baded5c72a704f7e6cd84cac', $result->vOut[0]->scriptPubKey->hex);
        $this->assertEquals('pubkey', $result->vOut[0]->scriptPubKey->type);

        // Test second vOut
        $this->assertEquals(40, $result->vOut[1]->value);
        $this->assertEquals(1, $result->vOut[1]->n);
        $this->assertEquals('0411db93e1dcdb8a016b49840f8c53bc1eb68a382e97b1482ecad7b148a6909a5cb2e0eaddfb84ccf9744464f82e160bfa9b8b64f9d4c03f999b8643f656b412a3 OP_CHECKSIG', $result->vOut[1]->scriptPubKey->asm);
        $this->assertEquals('410411db93e1dcdb8a016b49840f8c53bc1eb68a382e97b1482ecad7b148a6909a5cb2e0eaddfb84ccf9744464f82e160bfa9b8b64f9d4c03f999b8643f656b412a3ac', $result->vOut[1]->scriptPubKey->hex);
        $this->assertEquals('pubkey', $result->vOut[1]->scriptPubKey->type);
    }
}
