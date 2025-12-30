 [![PHPUnit ](.github/coverage.svg)](https://brianhenryie.github.io/bh-php-btc-rpc-explorer-api-client/) [![PHPStan ](https://img.shields.io/badge/PHPStan-Level%208%20❌-2a5ea7.svg)](https://github.com/szepeviktor/phpstan-wordpress)

# PHP `btc-rpc-explorer` API Client

A thin PHP API wrapper to provide strongly typed responses and convenience methods for [janoside/btc-rpc-explorer](https://github.com/janoside/btc-rpc-explorer), a _"Database-free, self-hosted Bitcoin explorer, via RPC to Bitcoin Core"_.

## Introduction

Ran Claude on [tyzbit/btcapi](https://github.com/tyzbit/btcapi) saying to use 
[BrianHenryIE/bh-php-bitcoinpostageinfo](https://github.com/BrianHenryIE/bh-php-bitcoinpostageinfo) as inspiration. Then downloaded all the examples (that I could) from the API docs (/api/docs) as fixtures for tests, wrote one. Going to commit now and ask Claude to write tests against all the fixtures. 

TODO: 
* Use brick/math for decimals, figure out when PHP_INT_MAX might be exceeded.
* Fix casing in property names, e.g. `txids` -> `txIds` or even `transactionIds`.
