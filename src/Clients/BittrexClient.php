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
}
