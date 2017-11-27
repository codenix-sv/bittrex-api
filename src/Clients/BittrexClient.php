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
    public function getTicker(string $market = 'BTC-LTC')
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
    public function getMarketSummary(string $market = 'BTC-LTC')
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
    public function getOrderBook(string $market = 'BTC-LTC', $type = 'both')
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
    public function getMarketHistory(string $market = 'BTC-LTC')
    {
        $parameters['market'] = $market;

        $request = $this->publicRequestManager->createGetRequest('/public/getmarkethistory', $parameters);

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
    public function getBalance(string $currency = 'BTC')
    {
        $parameters['currency'] = $currency;

        $request = $this->privateRequestManager->createGetRequest('/account/getbalance');

        return $this->get($request);
    }

    /**
     * @param string $currency
     * @return mixed
     */
    public function getDepositAddress(string $currency = 'BTC')
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
    public function getOrderHistory(string $market = 'BTC-LTC')
    {
        $parameters['market'] = $market;

        $request = $this->privateRequestManager->createGetRequest('/account/getorderhistory');

        return $this->get($request);
    }

    /**
     * @param string $currency
     * @return mixed
     */
    public function getWithdrawalHistory(string $currency = 'BTC')
    {
        $parameters['currency'] = $currency;

        $request = $this->privateRequestManager->createGetRequest('/account/getwithdrawalhistory');

        return $this->get($request);
    }

    /**
     * @param string $currency
     * @return mixed
     */
    public function getDepositHistory(string $currency = 'BTC')
    {
        $parameters['currency'] = $currency;

        $request = $this->privateRequestManager->createGetRequest('/account/getdeposithistory');

        return $this->get($request);
    }
}
