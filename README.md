# bittrex-api

[![Latest Stable Version](https://poser.pugx.org/codenix-sv/bittrex-api/v/stable)](https://packagist.org/packages/codenix-sv/bittrex-api)
[![Latest Unstable Version](https://poser.pugx.org/codenix-sv/bittrex-api/v/unstable)](https://packagist.org/packages/codenix-sv/bittrex-api)
[![License](https://poser.pugx.org/codenix-sv/bittrex-api/license)](https://packagist.org/packages/codenix-sv/bittrex-api)
[![Build Status](https://travis-ci.org/codenix-sv/bittrex-api.svg?branch=master)](https://travis-ci.org/codenix-sv/bittrex-api)
[![Maintainability](https://api.codeclimate.com/v1/badges/49b696439195269120b4/maintainability)](https://codeclimate.com/github/codenix-sv/bittrex-api/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/49b696439195269120b4/test_coverage)](https://codeclimate.com/github/codenix-sv/bittrex-api/test_coverage)

A simple PHP wrapper for [Bittrex API](https://bittrex.com/Home/Api). Bittrex is the next generation crypto trading platform.

## Requirements

- PHP >=7.1
- [Bittrex account](https://bittrex.com), API key and API secret

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
$ composer require codenix-sv/bittrex-api:~0.1
```
or add

```json
"codenix-sv/bittrex-api" : "~0.1"
```

to the require section of your application's `composer.json` file.

## Basic usage

### Example
```php
use codenixsv\Bittrex\BittrexManager;

$manager = new BittrexManager('API_KEY', 'API_SECRET');
$client = $manager->createClient();

$responce = $client->getBalances();
```
### Available methods

#### Public API

##### Get the open and available trading markets
```php
$responce = $client->getMarkets();
```
##### Get all supported currencies
```php
$responce = $client->getCurrencies();
```
##### Get the current tick values for a market
```php
$responce = $client->getTicker('BTC-LTC');
```
##### Get the last 24 hour summary of all active exchanges
```php
$responce = $client->getMarketSummaries();
```
##### Get the last 24 hour summary of all active exchanges for a market
```php
$responce = $client->getMarketSummary('BTC-LTC');
```
##### Get the orderbook for a given market
```php
$responce = $client->getOrderBook('BTC-LTC');
```
##### Get latest trades that have occurred for a specific market
```php
$responce = $client->getMarketHistory('BTC-LTC');
```

#### Market API

##### Place a buy order in a specific market
```php
$responce = $client->buyLimit('BTC-LTC', 1.2, 1.3);
```
##### Place a sell order in a specific market
```php
$responce = $client->sellLimit('BTC-LTC', 1.2, 1.3);
```
##### Cancel a buy or sell order
```php
$responce = $client->cancel('251c48e7-95d4-d53f-ad76-a7c6547b74ca9');
```
##### Get all orders that you currently have opened
```php
$responce = $client->getOpenOrders('BTC-LTC');
```

#### Account API

##### Get all balances from your account
```php
$responce = $client->getBalances();
```
##### Get balance from your account for a specific currency
```php
$responce = $client->getBalance('BTC');
```
##### Get or generate an address for a specific currency
```php
$responce = $client->getDepositAddress('BTC');
```
##### Withdraw funds from your account
```php
$responce = $client->withdraw('BTC', 20.40, 'EAC_ADDRESS');
```
##### Get a single order by uuid
```php
$responce = $client->getOrder('251c48e7-95d4-d53f-ad76-a7c6547b74ca9');
```
##### Get order history
```php
$responce = $client->getOrderHistory('BTC-LTC');
```
##### Get withdrawal history
```php
$responce = $client->getWithdrawalHistory('BTC');
```
##### Get deposit history
```php
$responce = $client->getDepositHistory('BTC');
```

## Further Information
Please, check the [Bittrex site](https://bittrex.com/Home/Api) documentation for further
information about API.

## License

**bittrex-api** is released under the BSD 3-Clause License. See the bundled [LICENSE](./LICENSE) for details.