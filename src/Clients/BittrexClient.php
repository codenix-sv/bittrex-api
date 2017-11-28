<?php

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
     * @return mixed
     */
    public function getMarkets()
    {
        $request = $this->publicRequestManager->createGetRequest('/public/getmarkets');

        return $this->get($request);
    }

    /**
     * @return mixed
     */
    public function getCurrencies()
    {
        $request = $this->publicRequestManager->createGetRequest('/public/getcurrencies');

        return $this->get($request);
    }

    /**
     * @param string $market
     * @return mixed
     */
    public function getTicker(string $market)
    {
        $parameters['market'] = $market;

        $request = $this->publicRequestManager->createGetRequest('/public/getticker', $parameters);

        return $this->get($request);
    }

    /**
     * @return mixed
     */
    public function getMarketSummaries()
    {
        $request = $this->publicRequestManager->createGetRequest('/public/getmarketsummaries');

        return $this->get($request);
    }

    /**
     * @param string $market
     * @return mixed
     */
    public function getMarketSummary(string $market)
    {
        $parameters['market'] = $market;
        $request = $this->publicRequestManager->createGetRequest('/public/getmarketsummary', $parameters);

        return $this->get($request);
    }

    /**
     * @param string $market
     * @param string $type
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
     * @param string $market
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
     * @param string $market
     * @param float $quantity
     * @param float $rate
     * @return mixed
     */
    public function buyLimit(string $market, float $quantity, float $rate)
    {
        $parameters['market'] = $market;
        $parameters['quantity'] = (string)$quantity;
        $parameters['rate'] = (string)$rate;

        $request = $this->privateRequestManager->createGetRequest('/market/buylimit');

        return $this->get($request);
    }

    /**
     * @param string $market
     * @param float $quantity
     * @param float $rate
     * @return mixed
     */
    public function sellLimit(string $market, float $quantity, float $rate)
    {
        $parameters['market'] = $market;
        $parameters['quantity'] = (string)$quantity;
        $parameters['rate'] = (string)$rate;

        $request = $this->privateRequestManager->createGetRequest('/market/selllimit');

        return $this->get($request);
    }

    /**
     * @param string $uuid
     * @return mixed
     */
    public function cancel(string $uuid)
    {
        $parameters['uuid'] = $uuid;

        $request = $this->privateRequestManager->createGetRequest('/market/cancel');

        return $this->get($request);
    }


    /**
     * @param string $market
     * @return mixed
     */
    public function getOpenOrders(string $market)
    {
        $parameters['market'] = $market;

        $request = $this->privateRequestManager->createGetRequest('/market/getopenorders');

        return $this->get($request);
    }

    /*
     ***************************  Account API  **************************
     */

    /**
     * @return mixed
     */
    public function getBalances()
    {
        $request = $this->privateRequestManager->createGetRequest('/account/getbalances');

        return $this->get($request);
    }

    /**
     * @param string $currency
     * @return mixed
     */
    public function getBalance(string $currency)
    {
        $parameters['currency'] = $currency;

        $request = $this->privateRequestManager->createGetRequest('/account/getbalance');

        return $this->get($request);
    }

    /**
     * @param string $currency
     * @return mixed
     */
    public function getDepositAddress(string $currency)
    {
        $parameters['currency'] = $currency;

        $request = $this->privateRequestManager->createGetRequest('/account/getdepositaddress');

        return $this->get($request);
    }

    /**
     * @param string $currency
     * @param float $quantity
     * @param string $address
     * @param string $paymentid
     * @return mixed
     */
    public function withdraw(string $currency, float $quantity, string $address, string $paymentid)
    {
        $parameters['currency'] = $currency;
        $parameters['quantity'] = (string)$quantity;
        $parameters['address'] = $address;
        $parameters['paymentid'] = $paymentid;

        $request = $this->privateRequestManager->createGetRequest('/account/withdraw');

        return $this->get($request);
    }

    /**
     * @param string $uuid
     * @return mixed
     */
    public function getOrder(string $uuid)
    {
        $parameters['uuid'] = $uuid;

        $request = $this->privateRequestManager->createGetRequest('/account/getorder');

        return $this->get($request);
    }

    /**
     * @param string $market
     * @return mixed
     */
    public function getOrderHistory(string $market)
    {
        $parameters['market'] = $market;

        $request = $this->privateRequestManager->createGetRequest('/account/getorderhistory');

        return $this->get($request);
    }

    /**
     * @param string $currency
     * @return mixed
     */
    public function getWithdrawalHistory(string $currency)
    {
        $parameters['currency'] = $currency;

        $request = $this->privateRequestManager->createGetRequest('/account/getwithdrawalhistory');

        return $this->get($request);
    }

    /**
     * @param string $currency
     * @return mixed
     */
    public function getDepositHistory(string $currency)
    {
        $parameters['currency'] = $currency;

        $request = $this->privateRequestManager->createGetRequest('/account/getdeposithistory');

        return $this->get($request);
    }
}
