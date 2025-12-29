<?php

namespace BrianHenryIE\BtcRpcExplorer\Contract;

use BrianHenryIE\BtcRpcExplorer\ContractTestCase;

class TxApiTest extends ContractTestCase
{
    /**
     * The first transaction sent on Bitcoin.
     */
    public function testFirstTransaction(): void
    {

        $txid = 'f4184fc596403b9d638783cf57adfe4c75c605f6356fbc91338530e9831e9e16';

        $api = $this->getApi();

        $result = $api->tx($txid);

        $this->assertEquals(275, $result->size);
    }
}
