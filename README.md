 [![PHPUnit ](.github/coverage.svg)](https://brianhenryie.github.io/bh-php-btc-rpc-explorer-api-client/) [![PHPStan ](https://img.shields.io/badge/PHPStan-Level%208%20❌-2a5ea7.svg)](https://github.com/szepeviktor/phpstan-wordpress)

# PHP `btc-rpc-explorer` API Client

A thin PHP API wrapper to provide strongly typed responses and convenience methods for [janoside/btc-rpc-explorer](https://github.com/janoside/btc-rpc-explorer), a _"Database-free, self-hosted Bitcoin explorer, via RPC to Bitcoin Core"_.

## Introduction

This is a simple API client using `psr/http-client-implementation` and `psr/http-factory-implementation`, then [json-mapper/json-mapper](https://github.com/JsonMapper/JsonMapper) ([jsonmapper.net](https://jsonmapper.net/)) to parse responses to strongly typed objects, using `strings` for floats/decimals.

Once published:

```
composer require brianhenryie/bh-php-btc-rpc-explorer-api-client
```

## Work in Progress

* ~~Fix JsonMapper mis-parsing associative array to stdclass~~
* ~~Fix casing in property names, e.g. `txids` -> `txIds` or even `transactionIds`.~~
* ~~Get PHPStan templates/generics working~~
* Generate Contract tests
* ~~Document abbreviations and jargon~~
* test failures/exceptions
* Add convenience `DateTimeInterface` functions for all unix time stamps
* Add a Docker Compose file for minimal server
* Need an GitHub Action to keep comments in BtcRpcExplorerApi updated with the traits it uses
* ~~Use brick/math for decimals, figure out when `PHP_INT_MAX` might be exceeded.~~

## Use

Create an instance of the API class with a PSR HTTP implementation. [Guzzle](https://github.com/guzzle/guzzle) is the most popular.
```php
$httpFactory = new \GuzzleHttp\Psr7\HttpFactory();
$client      = new \GuzzleHttp\Client();

$bitcoinRpcExplorer = new \BrianHenryIE\BtcRpcExplorer\BtcRpcExplorerApi(
    requestFactory: $httpFactory,
    streamFactory: $httpFactory,
    client: $client,
);
```


## Acknowledgements

Ran Claude on [tyzbit/btcapi](https://github.com/tyzbit/btcapi) saying to use
[BrianHenryIE/bh-php-bitcoinpostageinfo](https://github.com/BrianHenryIE/bh-php-bitcoinpostageinfo) as inspiration. Then downloaded all the examples (that I could) from the API docs (/api/docs) as fixtures for tests, wrote one. Going to commit now and ask Claude to write tests against all the fixtures. 
