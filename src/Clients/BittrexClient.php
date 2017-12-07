<?php
/**
 * @link https://github.com/codenix-sv/bittrex-api
 * @copyright Copyright (c) 2017 codenix-sv
 * @license https://github.com/codenix-sv/bittrex-api/blob/master/LICENSE
 */

namespace codenixsv\Bittrex\Clients;

use codenixsv\Bittrex\Http\HttpClient;
use codenixsv\Bittrex\Requests\Managers\RequestManager;

/**
 * Class BittrexClient
 * @package codenixsv\Bittrex
 */
class BittrexClient extends Client
{
    /**
     * @var RequestManager
     */
    private $publicRequestManager;

    /**
     * @var RequestManager
     */
    private $privateRequestManager;

    /**
     * BittrexClient constructor.
     * @param HttpClient $httpClient
     * @param RequestManager $publicRequestManager
     * @param RequestManager $privateRequestManager
     */
    public function __construct(
        HttpClient $httpClient,
        RequestManager $publicRequestManager,
        RequestManager $privateRequestManager
    ) {
        parent::__construct($httpClient);

        $this->publicRequestManager = $publicRequestManager;
        $this->privateRequestManager = $privateRequestManager;
    }

    /*
     ***************************  Public API  **************************
     */

    /**
     * Get the open and available trading markets
     *
     * @return mixed
     */
    public function getMarkets()
    {
        $request = $this->publicRequestManager->createGetRequest('/public/getmarkets');

        return $this->get($request);
    }

    /**
     * Get all supported currencies
     *
     * @return mixed
     */
    public function getCurrencies()
    {
        $request = $this->publicRequestManager->createGetRequest('/public/getcurrencies');

        return $this->get($request);
    }

    /**
     * Get the current tick values for a market
     *
     * @param string $market string literal for the market (e.g.: BTC-LTC)
     * @return mixed
     */
    public function getTicker(string $market)
    {
        $parameters['market'] = $market;

        $request = $this->publicRequestManager->createGetRequest('/public/getticker', $parameters);

        return $this->get($request);
    }

    /**
     * Get the last 24 hour summary of all active exchanges
     *
     * @return mixed
     */
    public function getMarketSummaries()
    {
        $request = $this->publicRequestManager->createGetRequest('/public/getmarketsummaries');

        return $this->get($request);
    }

    /**
     * Get the last 24 hour summary of all active exchanges for a market
     *
     * @param string $market string literal for the market (e.g.: BTC-LTC)
     * @return mixed
     */
    public function getMarketSummary(string $market)
    {
        $parameters['market'] = $market;
        $request = $this->publicRequestManager->createGetRequest('/public/getmarketsummary', $parameters);

        return $this->get($request);
    }

    /**
     * Get the orderbook for a given market
     *
     * @param string $market string literal for the market (e.g.: BTC-LTC)
     * @param string $type 'buy', 'sell' or 'both' to identify the type of orderbook to return
     * @return mixed
     */
    public function getOrderBook(string $market, $type = 'both')
    {
        $parameters['market'] = $market;
        $parameters['type'] = $type;

        $request = $this->publicRequestManager->createGetRequest('/public/getorderbook', $parameters);

        return $this->get($request);
    }

    /**
     * Get latest trades that have occured for a specific market
     *
     * @param string $market string literal for the market (e.g.: BTC-LTC)
     * @return mixed
     */
    public function getMarketHistory(string $market)
    {
        $parameters['market'] = $market;

        $request = $this->publicRequestManager->createGetRequest('/public/getmarkethistory', $parameters);

        return $this->get($request);
    }

    /*
     ***************************  Market API  **************************
     */

    /**
     * Place a buy order in a specific market
     *
     * @param string $market string literal for the market (e.g.: BTC-LTC)
     * @param float $quantity amount to purchase
     * @param float $rate rate at which to place the order
     * @return mixed
     */
    public function buyLimit(string $market, float $quantity, float $rate)
    {
        $parameters['market'] = $market;
        $parameters['quantity'] = (string)$quantity;
        $parameters['rate'] = (string)$rate;

        $request = $this->privateRequestManager->createGetRequest('/market/buylimit', $parameters);

        return $this->get($request);
    }

    /**
     * Place an sell order in a specific market
     *
     * @param string $market string literal for the market (e.g.: BTC-LTC)
     * @param float $quantity mount to purchase
     * @param float $rate rate at which to place the order
     * @return mixed
     */
    public function sellLimit(string $market, float $quantity, float $rate)
    {
        $parameters['market'] = $market;
        $parameters['quantity'] = (string)$quantity;
        $parameters['rate'] = (string)$rate;

        $request = $this->privateRequestManager->createGetRequest('/market/selllimit', $parameters);

        return $this->get($request);
    }

    /**
     * Cancel a buy or sell order
     *
     * @param string $uuid uuid of buy or sell order

     * @return mixed
     */
    public function cancel(string $uuid)
    {
        $parameters['uuid'] = $uuid;

        $request = $this->privateRequestManager->createGetRequest('/market/cancel', $parameters);

        return $this->get($request);
    }


    /**
     * Get all orders that you currently have opened
     *
     * @param string $market string literal for the market (e.g.: BTC-LTC)
     * @return mixed
     */
    public function getOpenOrders(string $market = null)
    {
        $parameters = [];

        if (!is_null($market)) {
            $parameters['market'] = $market;
        }

        $request = $this->privateRequestManager->createGetRequest('/market/getopenorders', $parameters);

        return $this->get($request);
    }

    /*
     ***************************  Account API  **************************
     */

    /**
     * Get all balances from your account
     *
     * @return mixed
     */
    public function getBalances()
    {
        $request = $this->privateRequestManager->createGetRequest('/account/getbalances');

        return $this->get($request);
    }

    /**
     * Get balance from your account for a specific currency
     *
     * @param string $currency string literal for the currency (e.g.: BTC)
     * @return mixed
     */
    public function getBalance(string $currency)
    {
        $parameters['currency'] = $currency;

        $request = $this->privateRequestManager->createGetRequest('/account/getbalance', $parameters);

        return $this->get($request);
    }

    /**
     * Get or generate an address for a specific currency
     *
     * @param string $currency string literal for the currency (e.g.: BTC)
     * @return mixed
     */
    public function getDepositAddress(string $currency)
    {
        $parameters['currency'] = $currency;

        $request = $this->privateRequestManager->createGetRequest('/account/getdepositaddress', $parameters);

        return $this->get($request);
    }

    /**
     * Withdraw funds from your account. note: please account for txfee
     *
     * @param string $currency string literal for the currency (e.g.: BTC)
     * @param float $quantity quantity of coins to withdraw
     * @param string $address address where to send the funds
     * @param string $paymentid used for CryptoNotes/BitShareX/Nxt optional field (memo/paymentid)

     * @return mixed
     */
    public function withdraw(string $currency, float $quantity, string $address, string $paymentid = null)
    {
        $parameters['currency'] = $currency;
        $parameters['quantity'] = (string)$quantity;
        $parameters['address'] = $address;

        if (!is_null($paymentid)) {
            $parameters['paymentid'] = $paymentid;
        }

        $request = $this->privateRequestManager->createGetRequest('/account/withdraw', $parameters);

        return $this->get($request);
    }

    /**
     * Get a single order by uuid
     *
     * @param string $uuid uuid of the buy or sell order
     * @return mixed
     */
    public function getOrder(string $uuid)
    {
        $parameters['uuid'] = $uuid;

        $request = $this->privateRequestManager->createGetRequest('/account/getorder', $parameters);

        return $this->get($request);
    }

    /**
     * Get our order history
     *
     * @param string $market string literal for the market (e.g.: BTC-LTC)
     * @return mixed
     */
    public function getOrderHistory(string $market = null)
    {
        $parameters = [];

        if (!is_null($market)) {
            $parameters['market'] = $market;
        }

        $request = $this->privateRequestManager->createGetRequest('/account/getorderhistory', $parameters);

        return $this->get($request);
    }

    /**
     * Get your withdrawal history
     *
     * @param string $currency string literal for the currency (e.g.: BTC)
     * @return mixed
     */
    public function getWithdrawalHistory(string $currency = null)
    {
        $parameters = [];

        if (!is_null($currency)) {
            $parameters['currency'] = $currency;
        }

        $request = $this->privateRequestManager->createGetRequest('/account/getwithdrawalhistory', $parameters);

        return $this->get($request);
    }

    /**
     * Get your deposit history
     *
     * @param string $currency string literal for the currency (e.g.: BTC)
     * @return mixed
     */
    public function getDepositHistory(string $currency = null)
    {
        $parameters = [];

        if (!is_null($currency)) {
            $parameters['currency'] = $currency;
        }

        $request = $this->privateRequestManager->createGetRequest('/account/getdeposithistory', $parameters);

        return $this->get($request);
    }
}
