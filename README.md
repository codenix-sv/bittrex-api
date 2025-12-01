# This repository is no longer active.
⛔ No new issues ⛔ No pull requests ⛔ No maintenance

Source code is kept only for reference purposes.

# bittrex-api
[![Build Status](https://travis-ci.com/codenix-sv/bittrex-api.svg?branch=master)](https://travis-ci.com/codenix-sv/bittrex-api)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/codenix-sv/bittrex-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/codenix-sv/bittrex-api/?branch=master)
[![Test Coverage](https://api.codeclimate.com/v1/badges/49b696439195269120b4/test_coverage)](https://codeclimate.com/github/codenix-sv/bittrex-api/test_coverage)
[![Maintainability](https://api.codeclimate.com/v1/badges/49b696439195269120b4/maintainability)](https://codeclimate.com/github/codenix-sv/bittrex-api/maintainability)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://github.com/codenix-sv/bittrex-api/blob/master/LICENSE)
![Packagist](https://img.shields.io/packagist/dt/codenix-sv/bittrex-api)

A simple PHP wrapper for [Bittrex API](https://bittrex.github.io/api/v1-1). Bittrex is the next generation crypto trading platform.

## Requirements

* PHP >= 7.2
* ext-json
* [Bittrex account](https://global.bittrex.com/), API key and API secret

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
$ composer require codenix-sv/bittrex-api
```
or add

```json
"codenix-sv/bittrex-api" : "^1.0"
```

to the require section of your application's `composer.json` file.

## Basic usage

### Example
```php
use Codenixsv\BittrexApi\BittrexClient;

$client = new BittrexClient();
$client->setCredential('API_KEY', 'API_SECRET');

$data = $client->public()->getMarkets();
```
## Available methods

### Public API

#### Get the open and available trading markets
```php
$data = $client->public()->getMarkets();
```

#### Get all supported currencies
```php
$data = $client->public()->getCurrencies();
```

#### Get the current tick values for a market
```php
$data = $client->public()->getTicker('BTC-LTC');
```
#### Get the last 24 hour summary of all active exchanges
```php
$data = $client->public()->getMarketSummaries();
```

#### Get the last 24 hour summary of all active exchanges for a market
```php
$data = $client->public()->getMarketSummary('BTC-LTC');
```

#### Get the orderbook for a given market
```php
$data = $client->public()->getOrderBook('BTC-LTC');
```

#### Get latest trades that have occurred for a specific market
```php
$data = $client->public()->getMarketHistory('BTC-LTC');
```

### Market API

#### Place a buy order in a specific market
```php
$data = $client->market()->buyLimit('BTC-LTC', 1.2, 1.3);
```

#### Place a sell order in a specific market
```php
$data = $client->market()->sellLimit('BTC-LTC', 1.2, 1.3);
```

#### Cancel a buy or sell order
```php
$data = $client->market()->cancel('251c48e7-95d4-d53f-ad76-a7c6547b74ca9');
```

#### Get all orders that you currently have opened
```php
$data = $client->market()->getOpenOrders('BTC-LTC');
```

### Account API

#### Get all balances from your account
```php
$data = $client->account()->getBalances();
```

#### Get balance from your account for a specific currency
```php
$data = $client->account()->getBalance('BTC');
```

#### Get or generate an address for a specific currency
```php
$data = $client->account()->getDepositAddress('BTC');
```

#### Withdraw funds from your account
```php
$data = $client->account()->withdraw('BTC', 20.40, 'EAC_ADDRESS');
```

#### Get a single order by uuid
```php
$data = $client->account()->getOrder('251c48e7-95d4-d53f-ad76-a7c6547b74ca9');
```

#### Get order history
```php
$data = $client->account()->getOrderHistory('BTC-LTC');
```

#### Get withdrawal history
```php
$data = $client->account()->getWithdrawalHistory('BTC');
```

#### Get deposit history
```php
$data = $client->account()->getDepositHistory('BTC');
```

## Further Information
Please, check the [Bittrex site](https://bittrex.github.io/api/v1-1) documentation for further
information about API.

## License

`codenix-sv/bittrex-api` is released under the MIT License. See the bundled [LICENSE](./LICENSE) for details.
