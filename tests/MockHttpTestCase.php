<?php

namespace BrianHenryIE\BtcRpcExplorer;

use PHPUnit\Framework\TestCase;
use PsrMock\Psr17\RequestFactory;
use PsrMock\Psr17\StreamFactory;
use PsrMock\Psr18\Client;
use PsrMock\Psr7\Response;

class MockHttpTestCase extends TestCase
{
    protected function getMockClientWithFixture(string $path, string $responseFilePath): BtcRpcExplorerApi
    {
        $absoluteFilePath = $this->getAbsoluteFromRelativeFilePath(
            relativeFilePath: $responseFilePath
        );

        $responseBody = file_get_contents(
            filename: $absoluteFilePath
        );

        return $this->getMockClient(
            path: $path,
            responseBody: $responseBody,
        );
    }

    private function getAbsoluteFromRelativeFilePath(string $relativeFilePath): string
    {
        $absolutePath = sprintf(
            '%s/%s',
            dirname(path: __DIR__),
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
