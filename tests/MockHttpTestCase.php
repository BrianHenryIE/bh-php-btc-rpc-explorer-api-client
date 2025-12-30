<?php

namespace BrianHenryIE\BtcRpcExplorer;

use Exception;
use PHPUnit\Framework\TestCase;
use PsrMock\Psr17\RequestFactory;
use PsrMock\Psr17\StreamFactory;
use PsrMock\Psr18\Client;
use PsrMock\Psr7\Response;

class MockHttpTestCase extends TestCase
{
    /**
     * @throws Exception
     */
    protected function getMockClientWithFixture(string $path, string $responseFilePath): BtcRpcExplorerApi
    {
        return $this->getMockClient(
            path: $path,
            responseBody: $this->getFixture(relativeFilePath: $responseFilePath),
        );
    }

    private function getFixture(string $relativeFilePath): string
    {
        $absoluteFilePath = $this->getAbsoluteFromRelativeFilePath(
            relativeFilePath: $relativeFilePath
        );

        $responseBody = file_get_contents(
            filename: $absoluteFilePath
        );

        if (empty($responseBody)) {
            throw new Exception('fixture');
        }

        return $responseBody;
    }

    private function getAbsoluteFromRelativeFilePath(string $relativeFilePath): string
    {
        $absolutePath = sprintf(
            '%s/%s/%s',
            dirname(path: __DIR__),
            'tests/_fixtures',
            $relativeFilePath
        );

        return is_readable(filename: $absolutePath)
            ? $absolutePath
            : $relativeFilePath;
    }


    protected static function getMockClient(string $path, string|bool $responseBody): BtcRpcExplorerApi
    {
        $httpFactory = new RequestFactory();
        $streamFactory = new StreamFactory();
        $client = new Client();

        // Normally ~ 'http://localhost:3002'.
        $explorerUrl = '';

        $sut = new BtcRpcExplorerApi(
            $httpFactory,
            $streamFactory,
            $client,
            $explorerUrl,
        );

        $responseStream = $streamFactory->createStream("$responseBody");

        $response = new Response()->withBody($responseStream);

        $client->addResponse(
            'GET',
            $path,
            $response
        );

        return $sut;
    }
}
