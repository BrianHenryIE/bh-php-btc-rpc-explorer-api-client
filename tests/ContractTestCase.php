<?php

/**
 * Loads `.env`,`.env.secret` into `$_ENV` and provides a method to get the API object.
 *
 * @package brianhenryie/bh-php-btc-rpc-explorer-api-client
 */

namespace BrianHenryIE\BtcRpcExplorer;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\HttpFactory;

class ContractTestCase extends \PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $requiredParams = ['SERVER'];

        $filesToLoad = ['.env.secret', '.env'];
        $projectRootDir = dirname(__DIR__, 1);

        $dotEnvNames = array_filter(
            array_map(
                fn (string $name) => file_exists($projectRootDir . '/' . $name) ? $name : null,
                $filesToLoad
            )
        );

        // if empty($dotEnvNames)...

        $dotenv = \Dotenv\Dotenv::createImmutable($projectRootDir, $dotEnvNames);
        $dotenv->load();

        $missingParams = array_reduce(
            $requiredParams,
            function (array $carry, string $param) {
                if (!isset($_ENV[$param])) {
                    $carry[] = $param;
                }
                return $carry;
            },
            []
        );

        if (! empty($missingParams)) {
            self::markTestSkipped(sprintf(
                '%s must be set in .env',
                implode(', ', $missingParams)
            ));
        }
    }

    protected static function getApi(): BtcRpcExplorerApi
    {
        $httpFactory = new HttpFactory();
        $client         = new Client();

        return new BtcRpcExplorerApi(
            requestFactory: $httpFactory,
            streamFactory: $httpFactory,
            client: $client,
            explorerUrl: $_ENV[ 'SERVER' ],
        );
    }
}
