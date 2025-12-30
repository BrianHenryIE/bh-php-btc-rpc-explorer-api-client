<?php

namespace BrianHenryIE\BtcRpcExplorer\Unit;

use BrianHenryIE\BtcRpcExplorer\Endpoints\AdminEndpoints;
use BrianHenryIE\BtcRpcExplorer\MockHttpTestCase;

/**
 * @see AdminEndpoints
 */
class AdminEndpointsTest extends MockHttpTestCase
{
    /**
     * @see AdminEndpoints::version
     */
    public function testVersion(): void
    {
        $fixture = 'api-docs/api-version.json';

        $sut = $this->getMockClientWithFixture('/api/version', $fixture);

        $result = $sut->version();

        $this->assertEquals('2.0.0', $result);
    }
}
